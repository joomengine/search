<?php
/**
 * @package    Joomla.Component.Builder
 *
 * @copyright  Copyright (C) 2015 Vast Development Method. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace VDM\Joomla\Componentbuilder\Search\Interfaces;


/**
 * Optional whole-document search and line-targeted replacement contract.
 *
 * @since 1.0.0
 */
interface DocumentSearchInterface extends SearchTypeInterface
{
	/**
	 * Search a complete value without splitting matches at line boundaries.
	 *
	 * Each result is keyed by its one-based starting line and contains the
	 * marked source snippet, including every line spanned by the match.
	 * Multiple matches beginning on the same line share one result.
	 *
	 * @param   string  $value  The complete string value.
	 *
	 * @return  array<int, string>|null  Marked snippets, or null when not found.
	 * @since   1.0.0
	 */
	public function lines(string $value): ?array;

	/**
	 * Replace matches beginning on one source line of a complete value.
	 *
	 * A match may continue across subsequent lines. Line numbers refer to
	 * the original value, before any replacement changes its line count.
	 * Content outside the selected matches must remain unchanged.
	 *
	 * @param   string  $value  The complete string value to update.
	 * @param   int     $line   The one-based starting line to update.
	 *
	 * @return  string  The updated complete string.
	 * @since   1.0.0
	 */
	public function replaceLine(string $value, int $line): string;
}
