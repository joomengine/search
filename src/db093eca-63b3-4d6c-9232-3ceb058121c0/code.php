<?php
/**
 * @package    Joomla.Component.Builder
 *
 * @created    4th September, 2022
 * @author     Llewellyn van der Merwe <https://dev.vdm.io>
 * @git        Joomla Component Builder <https://git.vdm.dev/joomla/Component-Builder>
 * @copyright  Copyright (C) 2015 Vast Development Method. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace VDM\Joomla\Componentbuilder\Search\Engine;


use VDM\Joomla\Componentbuilder\Search\Config;
use VDM\Joomla\Componentbuilder\Search\Interfaces\DocumentSearchInterface;
use VDM\Joomla\Componentbuilder\Search\Abstraction\Engine;


/**
 * Search Type String
 * 
 * @since 3.2.0
 */
class Basic extends Engine implements DocumentSearchInterface
{
	/**
	 * Construct and compile the pattern once for this search configuration.
	 *
	 * @param  Config|null  $config  The search configuration.
	 * @since  3.2.0
	 */
	public function __construct(?Config $config = null)
	{
		parent::__construct($config);
		$this->compileRegex();
	}

	/**
	 * Quote literal text and optionally tolerate whitespace differences.
	 * Whitespace runs match one or more spaces, tabs or line breaks. Keeping
	 * a separator prevents "foo bar" from incorrectly matching "foobar".
	 *
	 * @return  void
	 * @since   5.1.1
	 */
	protected function compileRegex(): void
	{
		$value = $this->searchValue;

		if ($value === null || $value === '')
		{
			$this->regexValue = '';
			return;
		}

		if ((int) $this->config->ignore_whitespace === 1)
		{
			$value = trim($value, " \t\r\n\v\f");

			if ($value === '')
			{
				$this->regexValue = '';
				return;
			}

			$parts = preg_split('/\s+/', $value);
			$quoted = array_map(static function (string $part): string {
				return preg_quote($part, '~');
			}, $parts);
			$pattern = implode('\s+', $quoted);
		}
		else
		{
			$pattern = preg_quote($value, '~');
		}

		// Constrain word-character endpoints without preventing code such as
		// "->method" from matching immediately after an object identifier.
		if ($this->wholeWord === 1)
		{
			if (preg_match('/^\w/', $value))
			{
				$pattern = '(?<!\w)' . $pattern;
			}

			if (preg_match('/\w$/D', $value))
			{
				$pattern .= '(?!\w)';
			}
		}

		$this->regexValue = '~' . $pattern . '~' . ($this->matchCase === 1 ? '' : 'i');
		$this->validatePattern();
	}
}

