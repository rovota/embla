<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Embla\Components\Forms\Inputs\Enums\InputType;

class Search extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Text);
		}
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		$this->attribute('pattern', $pattern);
		return $this;
	}

	// -----------------
	// Interactivity

	/**
	 * This attribute is only supported on Safari.
	 */
	public function useAutocorrect(bool $value): static
	{
		$this->attribute('autocorrect', $value ? 'on' : 'off');
		return $this;
	}

	/**
	 * This attribute is only supported on Safari.
	 */
	public function maxResults(int $number): static
	{
		$this->attribute('results', abs($number));
		return $this;
	}

}