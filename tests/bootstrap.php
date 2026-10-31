<?php
/** Minimal dependency doubles for exercising the exported powers without Joomla. */
namespace Joomla\Input {
	class Input
	{
		private array $data;
		public function __construct(array $data = []) { $this->data = $data; }
		public function get($name, $default = null, $filter = 'cmd')
		{
			$value = $this->data[$name] ?? $default;
			return strtoupper($filter) === 'INT' && $value !== null ? (int) $value : $value;
		}
	}
}
namespace VDM\Joomla\Abstraction {
	abstract class FunctionRegistry
	{
		private array $values = [];
		public function __get($name)
		{
			if (!array_key_exists($name, $this->values)) {
				$method = 'get' . str_replace('_', '', $name);
				$this->values[$name] = method_exists($this, $method) ? $this->$method() : null;
			}
			return $this->values[$name];
		}
		public function __set($name, $value) { $this->values[$name] = $value; }
		public function get($name, $default = null) { return $this->__get($name) ?? $default; }
		public function set($name, $value) { $this->__set($name, $value); return $this; }
	}
}
namespace VDM\Joomla\Utilities {
	abstract class ArrayHelper { public static function check($value): bool { return is_array($value) && count($value) > 0; } }
	abstract class StringHelper { public static function check($value): bool { return is_string($value) && strlen($value) > 0; } }
	abstract class ObjectHelper { public static function check($value): bool { return is_object($value) && count(get_object_vars($value)) > 0; } }
}
namespace {
	$root = dirname(__DIR__);
	$index = json_decode(file_get_contents($root . '/super-powers.json'), true, 512, JSON_THROW_ON_ERROR);
	$classes = [];
	foreach ($index as $entry) {
		$classes[$entry['namespace'] . '\\' . $entry['name']] = $entry;
	}
	spl_autoload_register(static function (string $class) use ($root, $classes): void {
		if (!isset($classes[$class])) { return; }
		$entry = $classes[$class];
		$file = $root . '/' . $entry['code'];
		if (TEST_SOURCE === 'php') {
			require $file;
			return;
		}
		// Use the exported declaration/imports with the authoritative JCB body.
		// Metadata/reference validation is provided separately by ai-doc's validator.
		$preview = file_get_contents($file);
		if (!preg_match('/^(?:abstract\s+|final\s+)?(?:class|interface|trait)\s+\w+[^\{]*\{/m', $preview, $match, PREG_OFFSET_CAPTURE)) {
			throw new \RuntimeException('Cannot locate declaration in ' . $file);
		}
		$end = $match[0][1] + strlen($match[0][0]);
		$source = substr($preview, 5, $end - 5) . "\n" . file_get_contents($root . '/' . $entry['power']) . "\n}\n";
		eval($source);
	});
}
