<?php
use VDM\Joomla\Componentbuilder\Search\Agent\Search;
use VDM\Joomla\Componentbuilder\Search\Agent\Update;
use VDM\Joomla\Componentbuilder\Search\Engine\Basic;
use VDM\Joomla\Componentbuilder\Search\Interfaces\SearchTypeInterface;

/** A third-party engine implementing only the original two-method contract. */
final class LegacySearchEngine implements SearchTypeInterface
{
	public function string(string $value): ?string
	{
		return strpos($value, 'old') === false ? null : str_replace('old', '[[old]]', $value);
	}
	public function replace(string $value): string { return str_replace('old', 'new', $value); }
}

test('agent search finds a multiline value using its starting line', static function (): void {
	$config = config(['search_value' => 'alpha beta']);
	$search = new Search($config, new Basic($config));
	truth($search->value("intro\nalpha\n  beta!", 17, 'code', 'items'));
	same([17 => ['code' => [2 => "[[alpha\n  beta]]!"]]], $search->get('items'));
});
test('search visits arbitrarily nested leaves without joining siblings', static function (): void {
	$config = config(['search_value' => 'alpha beta']);
	$search = new Search($config, new Basic($config));
	$value = ['one' => ['two' => ['three' => ['four' => ['five' => "alpha\n beta"]]]], 'alpha', 'beta'];
	truth($search->value($value, 17, 'code', 'items'));
	same(['one.two.three.four.five.1' => "[[alpha\n beta]]"], $search->get('items')[17]['code']);
});
test('re-evaluating a field removes its old matches', static function (): void {
	$config = config(['search_value' => 'old']);
	$search = new Search($config, new Basic($config));
	truth($search->value("old\nold", 17, 'code', 'items'));
	same(false, $search->value('new', 17, 'code', 'items'));
	$result = $search->get('items');
	same(false, isset($result[17]['code']));
});
test('null line updates all matches and null signals no change', static function (): void {
	$config = config(['search_value' => 'old', 'replace_value' => 'new']);
	$update = new Update(new Basic($config));
	same("new\r\nnew", $update->value("old\r\nold", null));
	same(null, $update->value('unchanged'));
	same(null, $update->value('old', 2));
});
test('nested numeric zero target updates only its selected sibling', static function (): void {
	$config = config(['search_value' => 'old', 'replace_value' => 'new']);
	$update = new Update(new Basic($config));
	$value = [0 => ['field' => "old\nold"], 1 => ['field' => "old\nold"]];
	same([0 => ['field' => "old\nnew"], 1 => ['field' => "old\nold"]], $update->value($value, '0.field.2'));
	same(null, $update->value($value, '2.field.1'));
});
test('deep result paths target the matching leaf and no other leaf', static function (): void {
	$config = config(['search_value' => 'old', 'replace_value' => 'new']);
	$update = new Update(new Basic($config));
	$value = ['a' => ['b' => ['c' => ['d' => ['e' => 'old', 'f' => 'old']]]]];
	$expected = ['a' => ['b' => ['c' => ['d' => ['e' => 'new', 'f' => 'old']]]]];
	same($expected, $update->value($value, 'a.b.c.d.e.1'));
});
test('dotted and backslash keys roundtrip from search to update', static function (): void {
	$config = config(['search_value' => 'old', 'replace_value' => 'new']);
	$search = new Search($config, new Basic($config));
	$update = new Update(new Basic($config));
	$value = ['a.b' => ['c\\d' => 'old'], 'a' => ['b' => ['c\\d' => 'old']]];
	truth($search->value($value, 17, 'code', 'items'));
	$paths = array_keys($search->get('items')[17]['code']);
	same(['a\\.b.c\\\\d.1', 'a.b.c\\\\d.1'], $paths);
	same(['a.b' => ['c\\d' => 'new'], 'a' => ['b' => ['c\\d' => 'old']]], $update->value($value, $paths[0]));
});
test('multiline agent update selects only match start lines', static function (): void {
	$config = config(['search_value' => 'alpha beta', 'replace_value' => 'new']);
	$update = new Update(new Basic($config));
	$value = "intro\r\nalpha\r\n beta\r\nalpha beta";
	same("intro\r\nnew\r\nalpha beta", $update->value($value, 2));
	same(null, $update->value($value, 3));
});
test('legacy engines remain searchable by line', static function (): void {
	$search = new Search(config(), new LegacySearchEngine());
	truth($search->value("before\rold\r\nafter\nold", 17, 'code', 'items'));
	same([2 => '[[old]]', 4 => '[[old]]'], $search->get('items')[17]['code']);
});
test('legacy targeted replacement preserves mixed original line endings', static function (): void {
	$update = new Update(new LegacySearchEngine());
	$value = "before\rold\r\nafter\nold\r\n";
	same("before\rnew\r\nafter\nold\r\n", $update->value($value, 2));
	same(null, $update->value('old', 2));
	same(null, $update->value($value, 99));
});
test('non-string nested values retain their types', static function (): void {
	$update = new Update(new LegacySearchEngine());
	$value = ['text' => 'old', 'zero' => 0, 'null' => null, 'false' => false, 'empty' => [], 'object' => (object) ['text' => 'old']];
	$expected = $value;
	$expected['text'] = 'new';
	same($expected, $update->value($value));
});
test('malformed targets cannot broaden a replacement', static function (): void {
	$update = new Update(new LegacySearchEngine());
	$value = ['group' => ['a' => 'old', 'b' => 'old']];
	foreach (['group.1', 'group.a.invalid', 'group.a.-1', 'group.a.1.extra', true, -1] as $line) {
		same(null, $update->value($value, $line));
	}
});
/** Existing subclass hook must still be able to veto a nested replacement. */
final class RestrictedUpdate extends Update
{
	protected function validateUpdateKey($line, $keys = null, $key = null, $ke = null, $k = null): bool
	{
		return (string) $keys !== '0' && parent::validateUpdateKey($line, $keys, $key, $ke, $k);
	}
}
test('legacy update validation hook can veto key zero safely', static function (): void {
	$update = new RestrictedUpdate(new LegacySearchEngine());
	$value = [0 => ['field' => 'old'], 1 => ['field' => 'old']];
	same([0 => ['field' => 'old'], 1 => ['field' => 'new']], $update->value($value));
	same(null, $update->value($value, '0.field.1'));
	same([0 => ['field' => 'old'], 1 => ['field' => 'new']], $update->value($value, '1.field.1'));
});
/** A legacy custom subclass has no compiled PCRE or document-search contract. */
final class LegacyDerivedEngine extends VDM\Joomla\Componentbuilder\Search\Abstraction\Engine implements SearchTypeInterface
{
	public function string(string $value): ?string
	{
		return strpos($value, 'old') === false ? null : str_replace('old', '[[old]]', $value);
	}
	public function replace(string $value): string { return str_replace('old', 'new', $value); }
}
test('existing Engine subclasses opt into document searching explicitly', static function (): void {
	$config = config();
	$engine = new LegacyDerivedEngine($config);
	same(false, $engine instanceof VDM\Joomla\Componentbuilder\Search\Interfaces\DocumentSearchInterface);
	$search = new Search($config, $engine);
	truth($search->value("before\r\nold\rafter", 17, 'code', 'items'));
	same([2 => '[[old]]'], $search->get('items')[17]['code']);
	$update = new Update($engine);
	same("old\r\nnew\rafter", $update->value("old\r\nold\rafter", 2));
});
test('rescanning an item drops omitted fields while preserving other results', static function (): void {
	$config = config(['search_value' => 'old']);
	$search = new Search($config, new Basic($config));
	$find = new VDM\Joomla\Componentbuilder\Search\Agent\Find($config, $search);
	$find->item((object) ['id' => 17, 'kept' => 'old', 'removed' => 'old'], null, 'items');
	$find->item((object) ['id' => 18, 'code' => 'old'], null, 'items');
	$find->item((object) ['id' => 17, 'code' => 'old'], null, 'archive');
	$find->item((object) ['id' => 17, 'kept' => 'old'], null, 'items');
	same(2, count($search->get('items')));
	same(['kept' => [1 => '[[old]]']], $search->get('items')[17]);
	same(['code' => [1 => '[[old]]']], $search->get('items')[18]);
	same([17 => ['code' => [1 => '[[old]]']]], $search->get('archive'));
	$find->item((object) ['id' => 17, 'kept' => 'new'], null, 'items');
	same([18 => ['code' => [1 => '[[old]]']]], $search->get('items'));
	same([18], array_keys($find->get('items')));
	same([17 => ['code' => [1 => '[[old]]']]], $search->get('archive'));
});
