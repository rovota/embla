<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Traits;

use Rovota\Embla\Utilities\Attributes\Autocomplete;
use Rovota\Embla\Utilities\Attributes\Capitalization;
use Rovota\Embla\Utilities\Attributes\InputMode;

trait InputCommons
{

	// -----------------
	// Identification

	public function name(string|int $name, bool $identifier = true): static
	{
		if (strlen((string)$name) > 0) {
			$this->attribute('name', $name);
			if ($identifier === true) {
				$this->attribute('id', $name);
			}
		}

		return $this;
	}

	// -----------------
	// Constraints

	public function minLength(int $number): static
	{
		return $this->attribute('minlength', abs($number));
	}

	public function maxLength(int $number): static
	{
		return $this->attribute('maxlength', abs($number));
	}

	// -----------------
	// Interactivity

	public function autocomplete(Autocomplete|string $type): static
	{
		return $this->attribute('autocomplete', $type instanceof Autocomplete ? $type->value : $type);
	}

	public function capitalize(Capitalization|string $type): static
	{
		return $this->attribute('autocapitalize', $type instanceof Capitalization ? $type->value : $type);
	}

	public function inputMode(InputMode|string $mode): static
	{
		return $this->attribute('inputmode', $mode instanceof InputMode ? $mode->value : $mode);
	}

}