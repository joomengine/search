<?php
/** Run with PHP 8.0+; no Composer dependencies or installed Joomla required. */
$source = $argv[1] ?? null;
if ($source === null) {
	foreach (['php', 'power'] as $mode) {
		passthru(escapeshellarg(PHP_BINARY) . ' -n ' . escapeshellarg(__FILE__) . ' ' . $mode, $status);
		if ($status !== 0) { exit($status); }
	}
	exit(0);
}
if (!in_array($source, ['php', 'power'], true)) {
	fwrite(STDERR, "Usage: php tests/run.php [php|power]\n");
	exit(2);
}
define('TEST_SOURCE', $source);
require __DIR__ . '/bootstrap.php';
set_error_handler(static function ($severity, $message, $file, $line): bool {
	if (!(error_reporting() & $severity)) { return false; }
	throw new ErrorException($message, 0, $severity, $file, $line);
});
$passed = 0;
$failed = 0;
function test(string $name, callable $body): void
{
	global $passed, $failed;
	try {
		$body();
		$passed++;
	} catch (Throwable $error) {
		$failed++;
		fwrite(STDERR, "FAIL: $name\n  " . get_class($error) . ': ' . $error->getMessage() . "\n");
	}
}
function same($expected, $actual): void
{
	if ($expected !== $actual) {
		throw new RuntimeException('Expected ' . var_export($expected, true) . ', received ' . var_export($actual, true));
	}
}
function truth($actual): void { same(true, $actual); }
function raises(string $class, callable $body): void
{
	try { $body(); } catch (Throwable $error) {
		if ($error instanceof $class) { return; }
		throw $error;
	}
	throw new RuntimeException('Expected ' . $class);
}
function config(array $options = []): VDM\Joomla\Componentbuilder\Search\Config
{
	$config = new VDM\Joomla\Componentbuilder\Search\Config(new Joomla\Input\Input($options));
	$config->marker_start = '[[';
	$config->marker_end = ']]';
	return $config;
}
require __DIR__ . '/engine.php';
require __DIR__ . '/agents.php';
if (is_file(__DIR__ . '/audit.php')) { require __DIR__ . '/audit.php'; }
fwrite(STDOUT, TEST_SOURCE . ": $passed passed, $failed failed\n");
exit($failed === 0 ? 0 : 1);
