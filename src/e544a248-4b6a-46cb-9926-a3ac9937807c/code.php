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

namespace VDM\Joomla\Componentbuilder\Search\Agent;


use VDM\Joomla\Componentbuilder\Search\Interfaces\DocumentSearchInterface;
use VDM\Joomla\Componentbuilder\Search\Factory;
use VDM\Joomla\Componentbuilder\Search\Config;
use VDM\Joomla\Componentbuilder\Search\Interfaces\SearchTypeInterface as SearchEngine;
use VDM\Joomla\Componentbuilder\Search\Interfaces\SearchInterface;


/**
 * Search Agent Search
 * 
 * @since 3.2.0
 */
class Search implements SearchInterface
{
	/**
	 * Results indexed by table, item, field and starting line/path.
	 *
	 * @var array
	 * @since 3.2.0
	 */
	protected array $found = [];

	/** @var Config Search configuration. @since 3.2.0 */
	protected Config $config;

	/** @var SearchEngine Search implementation. @since 3.2.0 */
	protected SearchEngine $search;

	/**
	 * @param Config|null       $config Search configuration.
	 * @param SearchEngine|null $search Search implementation.
	 * @since 3.2.0
	 */
	public function __construct(?Config $config = null, ?SearchEngine $search = null)
	{
		$this->config = $config ?: Factory::_('Config');
		$this->search = $search ?: Factory::_('Search');
	}

	/**
	 * Get the results for a table.
	 *
	 * @param string $table Table name.
	 * @return array|null
	 * @since 3.2.0
	 */
	public function get(string $table): ?array
	{
		return $this->found[$table] ?? null;
	}

	/**
	 * Search a field, replacing any earlier results for this field.
	 *
	 * @param mixed  $value Field value.
	 * @param int    $id    Item ID.
	 * @param string $field Field key.
	 * @param string $table Table name.
	 * @return bool
	 * @since 3.2.0
	 */
	public function value($value, int $id, string $field, string $table): bool
	{
		$found = $this->searchValue($value);

		if ($found !== null)
		{
			$this->prep($id, $field, $table);
			$this->found[$table][$id][$field] = $found;

			return true;
		}

		unset($this->found[$table][$id][$field]);

		if (empty($this->found[$table][$id]))
		{
			unset($this->found[$table][$id]);
		}

		if (empty($this->found[$table]))
		{
			unset($this->found[$table]);
		}

		return false;
	}

	/**
	 * Clear the results for a table.
	 *
	 * @param string $table Table name.
	 * @return void
	 * @since 3.2.0
	 */
	public function reset(string $table)
	{
		unset($this->found[$table]);
	}

	/**
	 * Clear one item's results before rescanning its current fields.
	 *
	 * This also removes results for fields no longer present on the item,
	 * while preserving other items in the same table.
	 *
	 * @param int    $id    Item ID.
	 * @param string $table Table name.
	 * @return void
	 * @since 1.1.0
	 */
	public function resetItem(int $id, string $table): void
	{
		unset($this->found[$table][$id]);

		if (empty($this->found[$table]))
		{
			unset($this->found[$table]);
		}
	}

	/**
	 * Search string leaves recursively without joining separate values.
	 *
	 * Result keys retain the existing dot-separated path and line format.
	 * Literal dots and backslashes in array keys are escaped reversibly.
	 *
	 * @param mixed $value Field value.
	 * @return array|null
	 * @since 3.2.0
	 */
	protected function searchValue($value): ?array
	{
		if (is_string($value))
		{
			return $value !== '' ? $this->string($value) : null;
		}

		if (!is_array($value))
		{
			return null;
		}

		$found = [];

		foreach ($value as $key => $child)
		{
			$matches = $this->searchValue($child);

			if ($matches === null)
			{
				continue;
			}

			$prefix = str_replace(['\\', '.'], ['\\\\', '\\.'], (string) $key);

			foreach ($matches as $line => $match)
			{
				$found[$prefix . '.' . $line] = $match;
			}
		}

		return $found !== [] ? $found : null;
	}

	/**
	 * Search a complete string when the engine supports document matching.
	 *
	 * Legacy engines retain their per-line behaviour. Result keys are the
	 * original, one-based starting lines, including for multiline matches.
	 *
	 * @param string $value Field value.
	 * @return array|null
	 * @since 3.2.0
	 */
	protected function string(string $value): ?array
	{
		$this->fieldCounter();

		if ($this->search instanceof DocumentSearchInterface)
		{
			return $this->search->lines($value);
		}

		$found = [];

		foreach (preg_split('/\R/', $value) as $index => $line)
		{
			$match = $this->search->string($line);

			if ($match !== null)
			{
				$found[$index + 1] = $match;
			}
		}

		return $found !== [] ? $found : null;
	}

	/**
	 * Prepare the result bucket.
	 *
	 * @param int    $id    Item ID.
	 * @param string $field Field key.
	 * @param string $table Table name.
	 * @return void
	 * @since 3.2.0
	 */
	protected function prep(int $id, string $field, string $table)
	{
		if (!isset($this->found[$table][$id][$field]))
		{
			$this->found[$table][$id][$field] = [];
		}
	}

	/**
	 * Count each string field searched once.
	 *
	 * @return void
	 * @since 3.2.0
	 */
	protected function fieldCounter()
	{
		$this->config->field_counter += 1;
	}
}

