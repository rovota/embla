<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Search extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Search);
		}
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		return $this->attribute('pattern', $pattern);
	}

	// -----------------
	// Interactivity

	/**
	 * This attribute is only supported on Safari.
	 */
	public function autocorrect(bool $value): static
	{
		return $this->attribute('autocorrect', $value ? 'on' : 'off');
	}

	/**
	 * This attribute is only supported on Safari.
	 */
	public function maxResults(int $number): static
	{
		return $this->attribute('results', abs($number));
	}

}