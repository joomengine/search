<?php
/**
 * Real Joomla/JCB integration fixtures. No stubs, SQL, writes, or service calls.
 * Append the statements (without this opening PHP tag) to the linked Demo
 * Importer custom admin view PHP tab, Custom Script (jform_php_view).
 * Preserve existing script code. Compile/install Demo and open its Importer view.
 * See tests/README.md for the full playground procedure.
 * Active Superpower references below must be resolved by the JCB compiler.
 */
$integrationSame = static function ($expected, $actual): void {
	if ($expected !== $actual)
	{
		throw new \RuntimeException('Expected ' . var_export($expected, true)
			. '; received ' . var_export($actual, true));
	}
};
$integrationConfig = static function (array $options = []) {
	$config = new Super___6e2ca779_f70e_4871_a138_0ee5eaec6a97___Power(new \Joomla\Input\Input($options));
	$config->marker_start = '[[';
	$config->marker_end = ']]';
	return $config;
};
$integrationBasic = static function (array $options = []) use ($integrationConfig) {
	return new Super___db093eca_63b3_4d6c_9232_3ceb058121c0___Power($integrationConfig($options));
};
$integrationRegex = static function (array $options = []) use ($integrationConfig) {
	return new Super___83efa9a0_4aec_41f8_9c05_b1ac9617746e___Power($integrationConfig($options));
};
$integrationCases = [];
$integrationCases['literal zero is searchable and replaceable'] = static function () use ($integrationBasic, $integrationSame): void {
	$engine = $integrationBasic(['search_value' => '0', 'replace_value' => 'one']);
	$integrationSame('[[0]]', $engine->string('0'));
	$integrationSame('one', $engine->replace('0'));
};
$integrationCases['spaces tabs and multiline indentation are equivalent'] = static function () use ($integrationBasic, $integrationSame): void {
	$engine = $integrationBasic(['search_value' => "  alpha beta\n gamma  "]);
	$integrationSame("[[alpha\t\tbeta\r\n\t gamma]]", $engine->string("alpha\t\tbeta\r\n\t gamma"));
	$integrationSame(false, $engine->match('alphabetagamma'));
};
$integrationCases['exact whitespace remains available'] = static function () use ($integrationBasic, $integrationSame): void {
	$engine = $integrationBasic(['search_value' => ' a  b ', 'ignore_whitespace' => 0]);
	$integrationSame(true, $engine->match(' a  b '));
	$integrationSame(false, $engine->match("a\tb"));
};
$integrationCases['blank queries leave documents unchanged'] = static function () use ($integrationBasic, $integrationSame): void {
	foreach ([null, '', "\t\r\n "] as $query)
	{
		$engine = $integrationBasic(['search_value' => $query, 'replace_value' => 'bad']);
		$integrationSame(null, $engine->string("a b\nc"));
		$integrationSame("a b\nc", $engine->replace("a b\nc"));
	}
};
$integrationCases['literal metacharacters and replacement backslashes remain literal'] = static function () use ($integrationBasic, $integrationSame): void {
	$query = '$a[0] / (x.*)';
	$replacement = '$1 ${2} \\1 C:\\tmp\\new';
	$engine = $integrationBasic(['search_value' => $query, 'replace_value' => $replacement]);
	$integrationSame(true, $engine->match($query));
	$integrationSame(false, $engine->match('a0 / xyz'));
	$integrationSame($replacement, $engine->replace($query));
};
$integrationCases['case and whole-word options work with PHP method snippets'] = static function () use ($integrationBasic, $integrationSame): void {
	$integrationSame(false, $integrationBasic(['search_value' => 'Needle', 'match_case' => 1])->match('needle'));
	$integrationSame(true, $integrationBasic(['search_value' => 'Needle'])->match('needle'));
	$engine = $integrationBasic(['search_value' => '->foo', 'whole_word' => 1]);
	$integrationSame('$obj[[->foo]]() and $obj->foobar()', $engine->string('$obj->foo() and $obj->foobar()'));
};
$integrationCases['multiline results retain starting lines and source formatting'] = static function () use ($integrationBasic, $integrationSame): void {
	$engine = $integrationBasic(['search_value' => 'alpha beta']);
	$integrationSame([2 => "  [[alpha\r\n\tbeta]];", 4 => '[[alpha beta]]'],
		$engine->lines("intro\r\n  alpha\r\n\tbeta;\r\nalpha beta"));
};
$integrationCases['selected multiline replacement preserves untouched line endings'] = static function () use ($integrationBasic, $integrationSame): void {
	$engine = $integrationBasic(['search_value' => 'alpha beta', 'replace_value' => 'done']);
	$value = "intro\r\n  alpha\r\n\tbeta;\r\nalpha beta\rtrailer\n";
	$integrationSame("intro\r\n  done;\r\nalpha beta\rtrailer\n", $engine->replaceLine($value, 2));
	$integrationSame($value, $engine->replaceLine($value, 3));
	$integrationSame($value, $engine->replaceLine($value, 99));
};
$integrationCases['regex captures and numeric pattern backreferences keep numbering'] = static function () use ($integrationRegex, $integrationSame): void {
	$engine = $integrationRegex(['search_value' => '(ab)(cd)', 'replace_value' => '$2-$1']);
	$integrationSame('[[abcd]]', $engine->string('abcd'));
	$integrationSame('cd-ab', $engine->replace('abcd'));
	$integrationSame(true, $integrationRegex(['search_value' => '(ab)\\1'])->match('abab'));
};
$integrationCases['regex anchors support CRLF CR LF and legacy newline forms'] = static function () use ($integrationRegex, $integrationSame): void {
	foreach (["\n", "\r\n", "\r", "\v", "\f", "\x85"] as $newline)
	{
		$engine = $integrationRegex(['search_value' => '^beta$', 'replace_value' => 'done']);
		$value = 'alpha' . $newline . 'beta' . $newline . 'gamma';
		$integrationSame([2 => '[[beta]]'], $engine->lines($value));
		$integrationSame('alpha' . $newline . 'done' . $newline . 'gamma', $engine->replaceLine($value, 2));
	}
};
$integrationCases['raw URL regex and explicit dotall work'] = static function () use ($integrationRegex, $integrationSame): void {
	$integrationSame(true, $integrationRegex(['search_value' => 'path/to/file'])->match('path/to/file'));
	$integrationSame(false, $integrationRegex(['search_value' => 'alpha.*gamma'])->match("alpha\nbeta\ngamma"));
	$integrationSame(true, $integrationRegex(['search_value' => '(?s)alpha.*gamma'])->match("alpha\nbeta\ngamma"));
};
$integrationCases['invalid regex raises a clear exception'] = static function () use ($integrationRegex): void {
	try
	{
		$integrationRegex(['search_value' => '(']);
	}
	catch (\InvalidArgumentException $error)
	{
		return;
	}
	throw new \RuntimeException('Expected InvalidArgumentException for an invalid regex.');
};
$integrationCases['lookaround replacement uses captures outside the selected match'] = static function () use ($integrationRegex, $integrationSame): void {
	$engine = $integrationRegex(['search_value' => '(?<=([a-z]):)old(?=!)', 'replace_value' => '$1-new']);
	$integrationSame("a:old!\nb:b-new!", $engine->replaceLine("a:old!\nb:old!", 2));
};
$integrationCases['zero-width matches at a trailing empty line finish correctly'] = static function () use ($integrationRegex, $integrationSame): void {
	$engine = $integrationRegex(['search_value' => '\\z', 'replace_value' => 'end']);
	$integrationSame([3 => '[[]]'], $engine->lines("one\r\ntwo\r"));
	$integrationSame("one\r\ntwo\rend", $engine->replaceLine("one\r\ntwo\r", 3));
};
$integrationCases['Search agent finds deep multiline subforms without joining siblings'] = static function () use ($integrationConfig, $integrationSame): void {
	$config = $integrationConfig(['search_value' => 'alpha beta']);
	$search = new Super___e544a248_4b6a_46cb_9926_a3ac9937807c___Power($config,
		new Super___db093eca_63b3_4d6c_9232_3ceb058121c0___Power($config));
	$value = ['one' => ['two' => ['three' => ['four' => ['five' => "alpha\n beta"]]]], 'alpha', 'beta'];
	$integrationSame(true, $search->value($value, 17, 'code', 'fixture'));
	$integrationSame(['one.two.three.four.five.1' => "[[alpha\n beta]]"], $search->get('fixture')[17]['code']);
};
$integrationCases['Update agent targets numeric key zero without changing siblings'] = static function () use ($integrationBasic, $integrationSame): void {
	$update = new Super___3ac29912_0681_4ca9_8197_d5a8f6a49ac7___Power($integrationBasic(['search_value' => 'old', 'replace_value' => 'new']));
	$value = [0 => ['field' => "old\nold"], 1 => ['field' => "old\nold"]];
	$integrationSame([0 => ['field' => "old\nnew"], 1 => ['field' => "old\nold"]], $update->value($value, '0.field.2'));
	$integrationSame(null, $update->value($value, '2.field.1'));
};
$integrationCases['escaped dotted and backslash paths roundtrip safely'] = static function () use ($integrationConfig, $integrationSame): void {
	$config = $integrationConfig(['search_value' => 'old', 'replace_value' => 'new']);
	$engine = new Super___db093eca_63b3_4d6c_9232_3ceb058121c0___Power($config);
	$search = new Super___e544a248_4b6a_46cb_9926_a3ac9937807c___Power($config, $engine);
	$update = new Super___3ac29912_0681_4ca9_8197_d5a8f6a49ac7___Power($engine);
	$value = ['a.b' => ['c\\d' => 'old'], 'a' => ['b' => ['c\\d' => 'old']]];
	$search->value($value, 17, 'code', 'fixture');
	$paths = array_keys($search->get('fixture')[17]['code']);
	$integrationSame(['a\\.b.c\\\\d.1', 'a.b.c\\\\d.1'], $paths);
	$integrationSame(['a.b' => ['c\\d' => 'new'], 'a' => ['b' => ['c\\d' => 'old']]], $update->value($value, $paths[0]));
};
$integrationCases['null target updates all and malformed targets update nothing'] = static function () use ($integrationBasic, $integrationSame): void {
	$update = new Super___3ac29912_0681_4ca9_8197_d5a8f6a49ac7___Power($integrationBasic(['search_value' => 'old', 'replace_value' => 'new']));
	$integrationSame("new\r\nnew", $update->value("old\r\nold", null));
	$integrationSame(null, $update->value('old', 2));
	$value = ['group' => ['a' => 'old', 'b' => 'old']];
	foreach (['group.1', 'group.a.invalid', 'group.a.-1', true] as $target)
	{
		$integrationSame(null, $update->value($value, $target));
	}
};
$integrationCases['repeated field searches remove stale matches and resetItem preserves siblings'] = static function () use ($integrationConfig, $integrationSame): void {
	$config = $integrationConfig(['search_value' => 'old']);
	$search = new Super___e544a248_4b6a_46cb_9926_a3ac9937807c___Power($config,
		new Super___db093eca_63b3_4d6c_9232_3ceb058121c0___Power($config));
	$search->value('old', 17, 'code', 'fixture');
	$search->value('old', 18, 'code', 'fixture');
	$integrationSame(false, $search->value('new', 17, 'code', 'fixture'));
	$integrationSame(false, isset($search->get('fixture')[17]['code']));
	$search->value('old', 17, 'other', 'fixture');
	$search->resetItem(17, 'fixture');
	$integrationSame([18 => ['code' => [1 => '[[old]]']]], $search->get('fixture'));
};
$integrationCases['selected regex replacements match native PHP capture expansion'] = static function () use ($integrationRegex, $integrationSame): void {
	foreach (['$0', '$1-$2', '${1}0', '\\1/\\2', '\\$1', '\\\\1', '$99'] as $replacement)
	{
		$engine = $integrationRegex(['search_value' => '(a)(b)?', 'replace_value' => $replacement]);
		$integrationSame("ab a\r\n" . preg_replace('~(a)(b)?~', $replacement, 'ab a'),
			$engine->replaceLine("ab a\r\nab a", 2));
	}
};

$integrationReport = [
	'suite' => 'JCB compiled Superpowers search integration',
	'harness_repository' => 'https://github.com/joomengine/search',
	'expected_source_branch' => 'feature/multiline-whitespace-search',
	'php_version' => PHP_VERSION,
	'joomla_version' => defined('JVERSION') ? JVERSION : null,
	'fixture_only' => true,
	'expected_power_count' => 25,
	'passed' => 0,
	'failed' => 0,
	'classes' => [],
	'checks' => []
];
// This explicit active-reference list covers every power in search/super-powers.json.
// Referencing the classes also instructs JCB to compile their dependencies.
$integrationClasses = [
	'Factory' => ['class' => Super___01a89ba8_f8bb_435c_93de_0a8f3fa9432a___Power::class, 'guid' => '01a89ba8-f8bb-435c-93de-0a8f3fa9432a', 'type' => 'abstract class'],
	'Model\\Insert' => ['class' => Super___02efe40a_7792_4c82_9444_7d0377243483___Power::class, 'guid' => '02efe40a-7792-4c82-9444-7d0377243483', 'type' => 'class'],
	'Agent' => ['class' => Super___0b658434_3767_401e_addc_eabfd1d0e94a___Power::class, 'guid' => '0b658434-3767-401e-addc-eabfd1d0e94a', 'type' => 'class'],
	'Interfaces\\SearchInterface' => ['class' => Super___0d9442ab_54d9_4947_a219_244cfaea3084___Power::class, 'guid' => '0d9442ab-54d9-4947-a219-244cfaea3084', 'type' => 'interface'],
	'Interfaces\\SearchTypeInterface' => ['class' => Super___117d8c9e_3f8d_40ae_b375_1efa2fe5538a___Power::class, 'guid' => '117d8c9e-3f8d-40ae-b375-1efa2fe5538a', 'type' => 'interface'],
	'Agent\\Find' => ['class' => Super___15d9e1a9_3364_4d69_9d9f_9b87db820e5c___Power::class, 'guid' => '15d9e1a9-3364-4d69-9d9f-9b87db820e5c', 'type' => 'class'],
	'Interfaces\\LoadInterface' => ['class' => Super___2bd1a32c_3d90_4646_9314_28d44d164f76___Power::class, 'guid' => '2bd1a32c-3d90-4646-9314-28d44d164f76', 'type' => 'interface'],
	'Database\\Load' => ['class' => Super___2dabfb4a_64cd_4c04_9772_4a75f9f3b710___Power::class, 'guid' => '2dabfb4a-64cd-4c04-9772-4a75f9f3b710', 'type' => 'class'],
	'Interfaces\\DocumentSearchInterface' => ['class' => Super___33f11e5c_7055_4a7a_90ed_2f456b578674___Power::class, 'guid' => '33f11e5c-7055-4a7a-90ed-2f456b578674', 'type' => 'interface'],
	'Agent\\Update' => ['class' => Super___3ac29912_0681_4ca9_8197_d5a8f6a49ac7___Power::class, 'guid' => '3ac29912-0681-4ca9-8197-d5a8f6a49ac7', 'type' => 'class'],
	'Interfaces\\InsertInterface' => ['class' => Super___4c44e5d3_750c_4609_88c8_aa441838b8fe___Power::class, 'guid' => '4c44e5d3-750c-4609-88c8-aa441838b8fe', 'type' => 'interface'],
	'Interfaces\\FindInterface' => ['class' => Super___55280ec7_e48d_431b_af25_10308dd30636___Power::class, 'guid' => '55280ec7-e48d-431b-af25-10308dd30636', 'type' => 'interface'],
	'Database\\Insert' => ['class' => Super___6caf9473_133c_49a9_afa0_9f84151b5155___Power::class, 'guid' => '6caf9473-133c-49a9-afa0-9f84151b5155', 'type' => 'class'],
	'Config' => ['class' => Super___6e2ca779_f70e_4871_a138_0ee5eaec6a97___Power::class, 'guid' => '6e2ca779-f70e-4871-a138-0ee5eaec6a97', 'type' => 'class'],
	'Service\\Model' => ['class' => Super___7f40cc7d_9ab8_4601_8a2b_4eb3d712a40a___Power::class, 'guid' => '7f40cc7d-9ab8-4601-8a2b-4eb3d712a40a', 'type' => 'class'],
	'Engine\\Regex' => ['class' => Super___83efa9a0_4aec_41f8_9c05_b1ac9617746e___Power::class, 'guid' => '83efa9a0-4aec-41f8-9c05-b1ac9617746e', 'type' => 'class'],
	'Abstraction\\Engine' => ['class' => Super___8f9449fc_bfbc_49a5_b146_d58c8c17dfdf___Power::class, 'guid' => '8f9449fc-bfbc-49a5-b146-d58c8c17dfdf', 'type' => 'abstract class'],
	'Agent\\Replace' => ['class' => Super___abc37ddd_1ff5_4204_9e5b_015ab4f3d4c7___Power::class, 'guid' => 'abc37ddd-1ff5-4204-9e5b-015ab4f3d4c7', 'type' => 'class'],
	'Interfaces\\ReplaceInterface' => ['class' => Super___afdae35d_fe7f_4055_99ea_afd8ff8349b6___Power::class, 'guid' => 'afdae35d-fe7f-4055-99ea-afd8ff8349b6', 'type' => 'interface'],
	'Service\\Agent' => ['class' => Super___cc6972a7_1574_4ae0_92a8_7f1012aac6f7___Power::class, 'guid' => 'cc6972a7-1574-4ae0-92a8-7f1012aac6f7', 'type' => 'class'],
	'Service\\Database' => ['class' => Super___d5de47ce_9a9e_4e76_a5c6_61ed74842ea3___Power::class, 'guid' => 'd5de47ce-9a9e-4e76-a5c6-61ed74842ea3', 'type' => 'class'],
	'Service\\Search' => ['class' => Super___da714ea5_96bb_4eb1_959b_39b457be9cd1___Power::class, 'guid' => 'da714ea5-96bb-4eb1-959b-39b457be9cd1', 'type' => 'class'],
	'Engine\\Basic' => ['class' => Super___db093eca_63b3_4d6c_9232_3ceb058121c0___Power::class, 'guid' => 'db093eca-63b3-4d6c-9232-3ceb058121c0', 'type' => 'class'],
	'Agent\\Search' => ['class' => Super___e544a248_4b6a_46cb_9926_a3ac9937807c___Power::class, 'guid' => 'e544a248-4b6a-46cb-9926-a3ac9937807c', 'type' => 'class'],
	'Model\\Load' => ['class' => Super___f523ab49_907a_4356_b064_51c85a187fbd___Power::class, 'guid' => 'f523ab49-907a-4356-b064-51c85a187fbd', 'type' => 'class']
];
foreach ($integrationClasses as $integrationName => $integrationDefinition)
{
	try
	{
		$integrationReflection = new \ReflectionClass($integrationDefinition['class']);
		$integrationMethods = [];
		foreach (['string', 'replace', 'lines', 'replaceLine', 'value', 'resetItem'] as $integrationMethod)
		{
			if ($integrationReflection->hasMethod($integrationMethod))
			{
				$integrationMethods[] = $integrationMethod;
			}
		}
		$integrationClassParts = array_map('strtolower', explode('\\', $integrationReflection->getName()));
		$integrationDemoIndex = array_search('demo', $integrationClassParts, true);
		$integrationDemoNamespace = $integrationDemoIndex !== false
			&& ($integrationClassParts[$integrationDemoIndex + 1] ?? null) === 'search';
		$integrationClassFile = $integrationReflection->getFileName();
		$integrationRealFile = is_string($integrationClassFile) ? realpath($integrationClassFile) : false;
		$integrationHostFile = is_string($integrationRealFile)
			&& strpos(strtolower(str_replace('\\', '/', $integrationRealFile)), '/com_componentbuilder/') !== false;
		$integrationActualType = $integrationReflection->isInterface() ? 'interface'
			: ($integrationReflection->isAbstract() ? 'abstract class' : 'class');
		$integrationReport['classes'][$integrationName] = [
			'guid' => $integrationDefinition['guid'],
			'name' => $integrationReflection->getName(),
			'type' => $integrationActualType,
			'expected_type' => $integrationDefinition['type'],
			'file' => $integrationRealFile ?: $integrationClassFile,
			'file_sha256' => $integrationRealFile !== false ? hash_file('sha256', $integrationRealFile) : null,
			'file_modified_utc' => $integrationRealFile !== false ? gmdate('c', filemtime($integrationRealFile)) : null,
			'demo_namespace' => $integrationDemoNamespace,
			'host_componentbuilder_file' => $integrationHostFile,
			'compiled_file_exists' => $integrationRealFile !== false,
			'methods' => $integrationMethods
		];
	}
	catch (\Throwable $integrationError)
	{
		$integrationReport['classes'][$integrationName] = [
			'guid' => $integrationDefinition['guid'],
			'error' => get_class($integrationError) . ': ' . $integrationError->getMessage()
		];
	}
}
$integrationCases['all 25 powers autoload from compiled Demo classes and files'] = static function () use (&$integrationReport, $integrationSame): void {
	$integrationSame(25, count($integrationReport['classes']));
	$problems = [];
	foreach ($integrationReport['classes'] as $name => $class)
	{
		if (isset($class['error']))
		{
			$problems[] = $name . ': ' . $class['error'];
		}
		elseif (!$class['demo_namespace'] || !$class['compiled_file_exists'] || $class['host_componentbuilder_file']
			|| $class['type'] !== $class['expected_type'])
		{
			$problems[] = $name . ': expected a compiled Demo\\Search power with type ' . $class['expected_type']
				. '; reflected ' . $class['name'] . ' (' . $class['type'] . ') at ' . $class['file'];
		}
	}
	if ($problems !== [])
	{
		throw new \RuntimeException(implode("\n", $problems));
	}
};
foreach ($integrationCases as $integrationName => $integrationCheck)
{
	try
	{
		$integrationCheck();
		$integrationReport['passed']++;
		$integrationReport['checks'][] = ['name' => $integrationName, 'status' => 'PASS'];
	}
	catch (\Throwable $integrationError)
	{
		$integrationReport['failed']++;
		$integrationReport['checks'][] = [
			'name' => $integrationName,
			'status' => 'FAIL',
			'exception' => get_class($integrationError),
			'message' => $integrationError->getMessage(),
			'file' => $integrationError->getFile(),
			'line' => $integrationError->getLine()
		];
	}
}
$integrationReportHtml = '<h2>Compiled search integration: ' . $integrationReport['passed'] . ' passed, '
	. $integrationReport['failed'] . ' failed</h2><pre id="search-integration-results" style="white-space:pre-wrap;overflow-wrap:anywhere">'
	. htmlspecialchars(json_encode($integrationReport, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
	. '</pre>';
echo $integrationReportHtml;
