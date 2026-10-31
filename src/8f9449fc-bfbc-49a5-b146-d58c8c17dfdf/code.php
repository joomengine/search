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

namespace VDM\Joomla\Componentbuilder\Search\Abstraction;


use VDM\Joomla\Componentbuilder\Search\Factory;
use VDM\Joomla\Componentbuilder\Search\Config;


/**
 * Search Engine
 * 
 * @since 3.2.0
 */
abstract class Engine
{
	/**
	 * Search Config
	 *
	 * @var    Config
	 * @since 3.2.0
	 */
	protected Config $config;

	/**
	 * Search Value
	 *
	 * @var    string|null
	 * @since 3.2.0
	 */
	protected ?string $searchValue;

	/**
	 * Replace Value
	 *
	 * @var    string
	 * @since 3.2.0
	 */
	protected string $replaceValue;

	/**
	 * Search Should Match Case
	 *
	 * @var    int
	 * @since 3.2.0
	 */
	protected int $matchCase = 0;

	/**
	 * Search Should Match Whole Word
	 *
	 * @var    int
	 * @since 3.2.0
	 */
	protected int $wholeWord = 0;

	/**
	 * Start marker
	 *
	 * @var    string
	 * @since 3.2.0
	 */
	protected string $start = '';

	/**
	 * End marker
	 *
	 * @var    string
	 * @since 3.2.0
	 */
	protected string $end = '';

	/**
	 * Constructor
	 *
	 * @param Config|null    $config  The search config object.
	 *
	 * @since 3.2.0
	 */
	public function __construct(?Config $config = null)
	{
		$this->config = $config ?: Factory::_('Config');

		// set search value
		$this->searchValue = $this->config->search_value;

		// set replace value
		$this->replaceValue = $this->config->replace_value;

		// set match case
		$this->matchCase = $this->config->match_case;

		// set whole word
		$this->wholeWord = $this->config->whole_word;

		// set start marker
		$this->start = $this->config->marker_start;

		// set end marker
		$this->end = $this->config->marker_end;

		$this->markedReplacement = $this->quoteReplacement($this->start) . '$0'
			. $this->quoteReplacement($this->end);
		$this->literalReplacement = $this->quoteReplacement($this->replaceValue);
	}

	/**
	 * we count every line being searched
	 *
	 * @since 3.2.0
	 */
	protected function lineCounter()
	{
		// we count every line we search
		$this->config->line_counter += 1;
	}

	/**
	 * Compiled PCRE pattern, shared by matching, marking and replacement.
	 *
	 * @var    string
	 * @since  1.1.0
	 */
	protected string $regexValue = '';

	/** @var string Literal-safe marker expression. @since 1.1.0 */
	protected string $markedReplacement;

	/** @var string Literal-safe replacement expression. @since 1.1.0 */
	protected string $literalReplacement;

	/**
	 * Search the complete value and mark matches without altering its whitespace.
	 *
	 * @param   string  $value  The original field value.
	 * @return  string|null
	 * @since   1.1.0
	 */
	public function string(string $value): ?string
	{
		$this->lineCounter();
		if ($this->regexValue === '')
		{
			return null;
		}

		$count = 0;
		$result = preg_replace($this->regexValue, $this->markedReplacement, $value, -1, $count);
		$this->checkResult($result === null ? false : $count);

		return $count > 0 ? $result : null;
	}

	/**
	 * Test a value without incrementing display counters.
	 *
	 * @param   string  $value  The original field value.
	 * @return  bool
	 * @since   1.1.0
	 */
	public function match(string $value): bool
	{
		if ($this->regexValue === '')
		{
			return false;
		}

		$result = preg_match($this->regexValue, $value);
		$this->checkResult($result);

		return $result === 1;
	}

	/**
	 * Replace non-overlapping matches in the original document.
	 *
	 * @param   string  $value  The original field value.
	 * @return  string
	 * @since   1.1.0
	 */
	public function replace(string $value): string
	{
		if ($this->regexValue === '')
		{
			return $value;
		}

		$count = 0;
		$result = preg_replace($this->regexValue, $this->replacementText(), $value, -1, $count);
		$this->checkResult($result === null ? false : $count);

		return $result;
	}

	/**
	 * Return marked original lines, keyed by each match's starting line.
	 * Multiple matches beginning on one line share one result. A multiline
	 * match includes all lines it touches. Unrelated lines are not returned.
	 *
	 * @param   string  $value  The original field value.
	 * @return  array|null
	 * @since   1.1.0
	 */
	public function lines(string $value): ?array
	{
		$this->countLines($value);
		$matches = $this->matches($value);

		if (!$matches)
		{
			return null;
		}

		$lines = $this->lineMap($value);
		$groups = [];

		foreach ($matches as $match)
		{
			$line = $this->lineAt($lines, $match[0][1]);
			$groups[$line][] = $match;
		}

		$found = [];

		foreach ($groups as $line => $group)
		{
			$last = $group[count($group) - 1][0];
			$end = $last[1] + strlen($last[0]);
			$lastLine = $this->lineAt($lines, max($last[1], $end - 1));
			$start = $lines[$line][0];
			$end = max($end, $lines[$lastLine][1]);
			$found[$line] = $this->mark(substr($value, $start, $end - $start), $group, $start);
		}

		return $found ?: null;
	}

	/**
	 * Replace matches starting on one physical line, retaining full context
	 * for lookarounds and multiline patterns and preserving all other bytes.
	 *
	 * @param   string  $value  The original field value.
	 * @param   int     $line   One-based starting line.
	 * @return  string
	 * @since   1.1.0
	 */
	public function replaceLine(string $value, int $line): string
	{
		$lines = $this->lineMap($value);

		if (!isset($lines[$line]))
		{
			return $value;
		}

		$selected = [];

		foreach ($this->matches($value) as $match)
		{
			if ($this->lineAt($lines, $match[0][1]) === $line)
			{
				$selected[] = $match;
			}
		}

		return $this->replaceMatches($value, $selected);
	}

	/**
	 * Find complete matches and captures with original byte offsets.
	 *
	 * @param   string  $value  The original field value.
	 * @return  array
	 * @throws  \RuntimeException  When PCRE cannot complete the search.
	 * @since   1.1.0
	 */
	protected function matches(string $value): array
	{
		if ($this->regexValue === '')
		{
			return [];
		}

		$result = preg_match_all($this->regexValue, $value, $matches,
			PREG_SET_ORDER | PREG_OFFSET_CAPTURE | PREG_UNMATCHED_AS_NULL);
		$this->checkResult($result);

		return $matches;
	}

	/**
	 * Surface matching failures instead of reporting a misleading no-match.
	 *
	 * @param   int|false  $result  The PCRE result.
	 * @return  void
	 * @since   1.1.0
	 */
	protected function checkResult($result): void
	{
		if ($result === false)
		{
			throw new \RuntimeException('Search failed: ' . (function_exists('preg_last_error_msg') ? preg_last_error_msg() : 'PCRE error ' . preg_last_error()));
		}
	}

	/**
	 * Validate patterns once when constructing an engine.
	 *
	 * @return  void
	 * @throws  \InvalidArgumentException
	 * @since   1.1.0
	 */
	protected function validatePattern(): void
	{
		if ($this->regexValue !== '' && @preg_match($this->regexValue, '') === false)
		{
			throw new \InvalidArgumentException('Invalid search pattern: ' . (function_exists('preg_last_error_msg') ? preg_last_error_msg() : 'PCRE error ' . preg_last_error()));
		}
	}

	/**
	 * Mark original slices in one pass; markers are always literal strings.
	 *
	 * @param   string  $value    The original document or snippet.
	 * @param   array   $matches  Matches with original byte offsets.
	 * @param   int     $offset   Snippet offset in the original document.
	 * @return  string
	 * @since   1.1.0
	 */
	protected function mark(string $value, array $matches, int $offset = 0): string
	{
		$result = '';
		$cursor = 0;

		foreach ($matches as $match)
		{
			$start = $match[0][1] - $offset;
			$result .= substr($value, $cursor, $start - $cursor)
				. $this->start . $match[0][0] . $this->end;
			$cursor = $start + strlen($match[0][0]);
		}

		return $result . substr($value, $cursor);
	}

	/**
	 * Build a replacement from original offsets, without re-searching output.
	 *
	 * @param   string  $value    The original field value.
	 * @param   array   $matches  Matches selected for replacement.
	 * @return  string
	 * @since   1.1.0
	 */
	protected function replaceMatches(string $value, array $matches): string
	{
		$result = '';
		$cursor = 0;

		foreach ($matches as $match)
		{
			$result .= substr($value, $cursor, $match[0][1] - $cursor)
				. $this->replacement($match);
			$cursor = $match[0][1] + strlen($match[0][0]);
		}

		return $result . substr($value, $cursor);
	}

	/**
	 * Supply a replacement expression; literal engines escape PCRE references.
	 *
	 * @return  string
	 * @since   1.1.0
	 */
	protected function replacementText(): string
	{
		return $this->literalReplacement;
	}

	/**
	 * Escape only the special characters in PHP replacement expressions.
	 *
	 * @param   string  $value  Literal replacement or marker text.
	 * @return  string
	 * @since   1.1.0
	 */
	protected function quoteReplacement(string $value): string
	{
		return str_replace(['\\', '$'], ['\\\\', '\\$'], $value);
	}

	/**
	 * Literal engines insert replacement text exactly as supplied.
	 *
	 * @param   array  $match  The match and captures.
	 * @return  string
	 * @since   1.1.0
	 */
	protected function replacement(array $match): string
	{
		return $this->replaceValue;
	}

	/**
	 * Map one-based physical lines to [start offset, content end offset].
	 * CRLF is one separator; PCRE \R also recognises LF, CR, VT, FF and NEL.
	 * Mixed line endings retain their exact original bytes. Offsets remain byte-based for consistency with PCRE.
	 *
	 * @param   string  $value  The original field value.
	 * @return  array
	 * @since   1.1.0
	 */
	protected function lineMap(string $value): array
	{
		preg_match_all('/\R/', $value, $breaks, PREG_OFFSET_CAPTURE);
		$lines = [];
		$start = 0;
		$line = 1;

		foreach ($breaks[0] as $break)
		{
			$lines[$line++] = [$start, $break[1]];
			$start = $break[1] + strlen($break[0]);
		}

		$lines[$line] = [$start, strlen($value)];

		return $lines;
	}

	/**
	 * Locate a byte offset using binary search in the physical line map.
	 *
	 * @param   array  $lines   Physical line map.
	 * @param   int    $offset  Original byte offset.
	 * @return  int
	 * @since   1.1.0
	 */
	protected function lineAt(array $lines, int $offset): int
	{
		$low = 1;
		$high = count($lines);

		while ($low < $high)
		{
			$middle = intdiv($low + $high + 1, 2);

			if ($lines[$middle][0] <= $offset)
			{
				$low = $middle;
			}
			else
			{
				$high = $middle - 1;
			}
		}

		return $low;
	}

	/**
	 * Count physical lines once per search, preserving the existing hook.
	 *
	 * @param   string  $value  The original field value.
	 * @return  void
	 * @since   1.1.0
	 */
	protected function countLines(string $value): void
	{
		$this->lineCounter();
		$this->config->line_counter += preg_match_all('/\R/', $value);
	}
}

