<?php
use VDM\Joomla\Componentbuilder\Search\Engine\Basic;
use VDM\Joomla\Componentbuilder\Search\Engine\Regex;

foreach ([Basic::class, Regex::class] as $engineClass) {
	test($engineClass . ' searches and replaces zero', static function () use ($engineClass): void {
		$engine = new $engineClass(config(['search_value' => '0', 'replace_value' => 'one']));
		truth($engine->match('0'));
		same('[[0]]', $engine->string('0'));
		same('one', $engine->replace('0'));
	});
	test($engineClass . ' empty query does nothing', static function () use ($engineClass): void {
		foreach ([null, ''] as $query) {
			$engine = new $engineClass(config(['search_value' => $query, 'replace_value' => 'bad']));
			same(false, $engine->match('value'));
			same(null, $engine->string('value'));
			same('value', $engine->replace('value'));
		}
	});
	test($engineClass . ' preserves whitespace and literal markers', static function () use ($engineClass): void {
		$config = config(['search_value' => 'found']);
		$config->marker_start = '$1\\';
		$config->marker_end = '\\$2';
		$engine = new $engineClass($config);
		same("  \$1\\found\\\$2\t", $engine->string("  found\t"));
	});
	test($engineClass . ' honours case sensitivity', static function () use ($engineClass): void {
		truth((new $engineClass(config(['search_value' => 'Needle'])))->match('needle'));
		same(false, (new $engineClass(config(['search_value' => 'Needle', 'match_case' => 1])))->match('needle'));
	});
}
test('literal metacharacters are quoted', static function (): void {
	$engine = new Basic(config(['search_value' => '$a[0] / (x.*)']));
	truth($engine->match('$a[0] / (x.*)'));
	same(false, $engine->match('a0 / xyz'));
});
test('literal replacements retain dollar and backslash characters', static function (): void {
	$replacement = '$1 ${2} \\1 C:\\tmp\\new';
	$engine = new Basic(config(['search_value' => 'old', 'replace_value' => $replacement]));
	same($replacement . ' ' . $replacement, $engine->replace('old old'));
});
test('flexible whitespace is enabled by default', static function (): void {
	$config = config(['search_value' => " alpha\tbeta\n gamma  "]);
	same(1, $config->ignore_whitespace);
	$engine = new Basic($config);
	foreach (["alpha beta gamma", "alpha\t\tbeta\r\n    gamma", "alpha\rbeta\ngamma"] as $value) {
		truth($engine->match($value));
		same('[[' . $value . ']]', $engine->string($value));
	}
	same(false, $engine->match('alphabetagamma'));
});
test('exact whitespace remains available', static function (): void {
	$engine = new Basic(config(['search_value' => " a  b ", 'ignore_whitespace' => 0]));
	truth($engine->match(" a  b "));
	same(false, $engine->match("a\tb"));
	same(false, $engine->match('a  b'));
});
test('blank flexible query is not a document-wide match', static function (): void {
	$engine = new Basic(config(['search_value' => "\t\r\n ", 'replace_value' => 'bad']));
	same(null, $engine->string("a b\nc"));
	same("a b\nc", $engine->replace("a b\nc"));
});
test('whole-word literal search excludes partial identifiers', static function (): void {
	$engine = new Basic(config(['search_value' => 'word', 'whole_word' => 1]));
	same('wording [[word]] sword word_2', $engine->string('wording word sword word_2'));
});
test('multiline matching reports starting lines and full source spans', static function (): void {
	$engine = new Basic(config(['search_value' => 'alpha beta']));
	same([2 => "  [[alpha\r\n\tbeta]];", 4 => '[[alpha beta]]'], $engine->lines("intro\r\n  alpha\r\n\tbeta;\r\nalpha beta"));
});
test('multiline selected replacement preserves all unselected bytes', static function (): void {
	$engine = new Basic(config(['search_value' => 'alpha beta', 'replace_value' => 'done']));
	$value = "intro\r\n  alpha\r\n\tbeta;\r\nalpha beta\rtrailer\n";
	same("intro\r\n  done;\r\nalpha beta\rtrailer\n", $engine->replaceLine($value, 2));
	same($value, $engine->replaceLine($value, 3));
	same($value, $engine->replaceLine($value, 0));
	same($value, $engine->replaceLine($value, 99));
});
test('multiple matches beginning on one line are replaced together', static function (): void {
	$engine = new Basic(config(['search_value' => 'x y', 'replace_value' => 'z']));
	same('[[x y]] [[x y]]', $engine->lines('x y x y')[1]);
	same("z z\nx y", $engine->replaceLine("x y x y\nx y", 1));
});
test('UTF-8 source prefix does not corrupt byte offsets', static function (): void {
	$engine = new Basic(config(['search_value' => 'alpha beta', 'replace_value' => 'done']));
	same("éè\r\n猫 done!", $engine->replaceLine("éè\r\n猫 alpha\n\tbeta!", 2));
});
test('regex captures preserve their original numbering', static function (): void {
	$engine = new Regex(config(['search_value' => '(ab)(cd)', 'replace_value' => '$2-$1']));
	same('[[abcd]]', $engine->string('abcd'));
	same('cd-ab', $engine->replace('abcd'));
});
test('regex numeric pattern backreferences are unshifted', static function (): void {
	$engine = new Regex(config(['search_value' => '(ab)\\1']));
	truth($engine->match('abab'));
	same(false, $engine->match('abac'));
});
test('regex slash and alternative delimiter characters remain usable', static function (): void {
	foreach (['path/to/file', '[/~#%!]'] as $pattern) {
		$engine = new Regex(config(['search_value' => $pattern]));
		truth($engine->match('path/to/file'));
	}
});
test('regex multiline anchors and explicit dotall retain their meaning', static function (): void {
	$anchors = new Regex(config(['search_value' => '^beta$']));
	same([2 => '[[beta]]'], $anchors->lines("alpha\nbeta\ngamma"));
	same(false, (new Regex(config(['search_value' => 'alpha.*gamma'])))->match("alpha\nbeta\ngamma"));
	truth((new Regex(config(['search_value' => '(?s)alpha.*gamma'])))->match("alpha\nbeta\ngamma"));
});
test('regex multiline replacement uses full captures on selected line', static function (): void {
	$engine = new Regex(config(['search_value' => '(alpha)\\s+(beta)', 'replace_value' => '$2:$1']));
	same("beta:alpha\r\nalpha beta", $engine->replaceLine("alpha\r\nbeta\r\nalpha beta", 1));
});
test('invalid regular expression is rejected explicitly', static function (): void {
	raises(InvalidArgumentException::class, static function (): void {
		new Regex(config(['search_value' => '(']));
	});
});
test('zero-width regex matches finish and retain original offsets', static function (): void {
	$engine = new Regex(config(['search_value' => '(?=old)', 'replace_value' => '>']));
	same('[[]]old', $engine->string('old'));
	same('>old >old', $engine->replace('old old'));
	same("old\n>old", $engine->replaceLine("old\nold", 2));
});
test('regex replacement syntax agrees with PHP for captures and escapes', static function (): void {
	$pattern = '(a)(b)?';
	$value = 'ab a';
	foreach (['$0', '$1-$2', '${1}0', '\\1/\\2', '$10', '\\$1', '\\\\1', '$99', '${99}', '$100', 'literal\\tail'] as $replacement) {
		$engine = new Regex(config(['search_value' => $pattern, 'replace_value' => $replacement]));
		same(preg_replace('~' . $pattern . '~', $replacement, $value), $engine->replace($value));
	}
});
test('selected regex replacement retains lookaround captures outside the match', static function (): void {
	$engine = new Regex(config(['search_value' => '(?<=([a-z]):)old(?=!)', 'replace_value' => '$1-new']));
	same("a:old!\nb:b-new!", $engine->replaceLine("a:old!\nb:old!", 2));
});
test('PCRE execution failure is explicit instead of a false no-match', static function (): void {
	$oldLimit = ini_get('pcre.backtrack_limit');
	try {
		ini_set('pcre.backtrack_limit', '10');
		$engine = new Regex(config(['search_value' => '(*NO_JIT)(a+)+$']));
		raises(RuntimeException::class, static function () use ($engine): void {
			$engine->match(str_repeat('a', 40) . '!');
		});
	} finally {
		ini_set('pcre.backtrack_limit', $oldLimit);
	}
});
test('line counters count each physical line once per document scan', static function (): void {
	$config = config(['search_value' => 'x']);
	$engine = new Basic($config);
	$engine->lines("x\r\nx\rx\n");
	same(4, $config->line_counter);
	$engine->match('x');
	$engine->replace('x');
	same(4, $config->line_counter);
});
test('zero-width end-of-document matches belong to the trailing empty line', static function (): void {
	$engine = new Regex(config(['search_value' => '\\z', 'replace_value' => 'end']));
	same([3 => '[[]]'], $engine->lines("one\r\ntwo\r"));
	same("one\r\ntwo\rend", $engine->replaceLine("one\r\ntwo\r", 3));
	same("one\r\ntwo\r", $engine->replaceLine("one\r\ntwo\r", 2));
});
test('mixed line endings retain exact match-start numbering', static function (): void {
	$engine = new Basic(config(['search_value' => 'hit']));
	same([2 => '[[hit]]', 3 => '[[hit]]', 4 => '[[hit]]'], $engine->lines("skip\r\nhit\rhit\nhit\r\n"));
});
test('whole-word punctuation endpoints do not demand artificial boundaries', static function (): void {
	$engine = new Basic(config(['search_value' => '$item[0]', 'whole_word' => 1]));
	same('read [[$item[0]]] and x[[$item[0]]] and [[$item[0]]]x', $engine->string('read $item[0] and x$item[0] and $item[0]x'));
});
test('selected regex replacement agrees with PHP capture expansion', static function (): void {
	$pattern = '(a)(b)?';
	$line = 'ab a';
	foreach (['$0', '$1-$2', '${1}0', '\\1/\\2', '$10', '\\$1', '\\\\1', '$99', '${99}', '$100', 'literal\\tail'] as $replacement) {
		$engine = new Regex(config(['search_value' => $pattern, 'replace_value' => $replacement]));
		same("ab a\r\n" . preg_replace('~' . $pattern . '~', $replacement, $line) . "\r\nab a", $engine->replaceLine("ab a\r\nab a\r\nab a", 2));
	}
});
test('regex line anchors work across legacy physical newline forms', static function (): void {
	foreach (["\n", "\r\n", "\r", "\v", "\f", "\x85"] as $newline) {
		$engine = new Regex(config(['search_value' => '^beta$', 'replace_value' => 'done']));
		$value = 'alpha' . $newline . 'beta' . $newline . 'gamma';
		same([2 => '[[beta]]'], $engine->lines($value));
		same('alpha' . $newline . 'done' . $newline . 'gamma', $engine->replaceLine($value, 2));
	}
});
test('whole-word method snippets work after an object expression', static function (): void {
	$engine = new Basic(config(['search_value' => '->foo', 'whole_word' => 1]));
	same('$obj[[->foo]]() and $obj->foobar()', $engine->string('$obj->foo() and $obj->foobar()'));
	$parentheses = new Basic(config(['search_value' => '(foo)', 'whole_word' => 1]));
	same('x[[(foo)]]y', $parentheses->string('x(foo)y'));
});
test('quoted regex text containing common delimiters remains literal', static function (): void {
	$value = '~#%!/@;`=&:,\'-"' . "\x1F";
	$engine = new Regex(config(['search_value' => '\\Q' . $value . '\\E']));
	truth($engine->match($value));
	same('[[' . $value . ']]', $engine->string($value));
});
test('regex with no safe supported delimiter fails explicitly', static function (): void {
	$value = '~#%!/@;`=&:,\'-"';
	for ($code = 1; $code < 32; $code++) {
		if (!in_array($code, [9, 10, 11, 12, 13], true)) { $value .= chr($code); }
	}
	raises(InvalidArgumentException::class, static function () use ($value): void {
		new Regex(config(['search_value' => '\\Q' . $value . '\\E']));
	});
});
