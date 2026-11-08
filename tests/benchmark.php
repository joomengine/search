<?php
/** Optional repeatable microbenchmark. Run: php -n tests/benchmark.php */
define('TEST_SOURCE', 'php');
require __DIR__ . '/bootstrap.php';
use Joomla\Input\Input;
use VDM\Joomla\Componentbuilder\Search\Config;
use VDM\Joomla\Componentbuilder\Search\Engine\Basic;

function measure(string $name, int $iterations, callable $operation): void
{
	$operation(); // Warm autoloading and PCRE's compiled-pattern cache.
	$start = microtime(true);
	for ($index = 0; $index < $iterations; $index++) { $operation(); }
	$seconds = microtime(true) - $start;
	printf("%-34s %6d calls %9.3f ms %9.3f us/call\n", $name, $iterations, $seconds * 1000, $seconds * 1000000 / $iterations);
}

$config = new Config(new Input(['search_value' => 'needle value', 'replace_value' => 'replacement']));
$engine = new Basic($config);
$singleMiss = str_repeat('ordinary source text ', 20);
$singleHits = str_repeat('needle value; ', 30);
$document = str_repeat("\tpublic function ordinary(): void {}\r\n", 5000) . "needle\r\n\t value\r\n";
$documentMiss = str_repeat("\tpublic function ordinary(): void {}\r\n", 5000);
printf("PHP %s; document %d bytes. Local timings are workload-specific.\n", PHP_VERSION, strlen($document));
measure('single line no match: string', 20000, static function () use ($engine, $singleMiss) { $engine->string($singleMiss); });
measure('single line 30 matches: string', 10000, static function () use ($engine, $singleHits) { $engine->string($singleHits); });
measure('single line 30 matches: replace', 10000, static function () use ($engine, $singleHits) { $engine->replace($singleHits); });
measure('large document no match: lines', 100, static function () use ($engine, $documentMiss) { $engine->lines($documentMiss); });
measure('large multiline match: lines', 100, static function () use ($engine, $document) { $engine->lines($document); });
measure('large multiline match: replace', 100, static function () use ($engine, $document) { $engine->replace($document); });
printf("Peak process memory: %.1f MiB\n", memory_get_peak_usage(true) / 1048576);
