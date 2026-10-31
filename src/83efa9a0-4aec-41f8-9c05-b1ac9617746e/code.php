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
 * Search Type Regex
 * 
 * @since 3.2.0
 */
class Regex extends Engine implements DocumentSearchInterface
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
	 * Compile a raw PCRE expression without adding capturing groups.
	 * Numeric captures/backreferences retain their user-supplied numbering.
	 * Multiline anchors are enabled; use (?s) when dot must cross newlines.
	 *
	 * @return  void
	 * @since   5.1.1
	 */
	protected function compileRegex(): void
	{
		if ($this->searchValue === null || $this->searchValue === '')
		{
			$this->regexValue = '';
			return;
		}

		// An absent delimiter leaves every escape and \Q...\E region intact.
		// Fail explicitly for the pathological case containing this complete
		// alphabet rather than rewriting and silently changing the expression.
		$delimiter = null;
		$candidates = ['~', '#', '%', '!', '/', '@', ';', '`', '=', '&', ':', ',', '-', '"', "'"];

		for ($code = 1; $code < 32; $code++)
		{
			if (!in_array($code, [9, 10, 11, 12, 13], true))
			{
				$candidates[] = chr($code);
			}
		}

		foreach ($candidates as $candidate)
		{
			if (strpos($this->searchValue, $candidate) === false)
			{
				$delimiter = $candidate;
				break;
			}
		}

		if ($delimiter === null)
		{
			throw new \InvalidArgumentException('Search expression contains every supported delimiter; use hexadecimal escapes for literal control characters.');
		}

		// Preserve anchored searches across every physical newline accepted by
		// the legacy line splitter. A user newline directive can override ANY.
		$this->regexValue = $delimiter . '(*ANY)' . $this->searchValue . $delimiter
			. ($this->matchCase === 1 ? 'm' : 'mi');
		$this->validatePattern();
	}

	/**
	 * Regex replacement text retains PHP's numbered capture syntax.
	 *
	 * @return  string
	 * @since   1.1.0
	 */
	protected function replacementText(): string
	{
		return $this->replaceValue;
	}

	/**
	 * Expand PHP-style numbered replacement references using the captures
	 * from the original document, including lookarounds outside the match.
	 * Supports $0..$99, ${0}..${99}, backslash-number and escaped slashes/$.
	 *
	 * @param   array  $match  Original captures and their offsets.
	 * @return  string
	 * @since   1.1.0
	 */
	protected function replacement(array $match): string
	{
		$result = '';
		$length = strlen($this->replaceValue);

		for ($index = 0; $index < $length; $index++)
		{
			$character = $this->replaceValue[$index];

			if ($character === '\\' && $index + 1 < $length
				&& ($this->replaceValue[$index + 1] === '\\' || $this->replaceValue[$index + 1] === '$'))
			{
				$result .= $this->replaceValue[++$index];
				continue;
			}

			if ($character === '$' || $character === '\\')
			{
				$tail = substr($this->replaceValue, $index + 1, 4);
				$reference = [];

				if (preg_match('/^([0-9]{1,2})/', $tail, $reference)
					|| ($character === '$' && preg_match('/^\{([0-9]{1,2})\}/', $tail, $reference)))
				{
					$result .= $match[(int) $reference[1]][0] ?? '';
					$index += strlen($reference[0]);
					continue;
				}
			}

			$result .= $character;
		}

		return $result;
	}
}

