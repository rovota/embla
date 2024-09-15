<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs;

use Rovota\Core\Support\Str;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\Autocomplete;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\Capitalization;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\InputMode;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\InputType;

trait InputCommons
{

	// -----------------
	// Identification

	public function name(string|int $name, bool $identifier = true): static
	{
		if (strlen((string) $name) > 0) {
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
		$this->attribute('minlength', abs($number));
		return $this;
	}

	public function maxLength(int $number): static
	{
		$this->attribute('maxlength', abs($number));
		return $this;
	}

	// -----------------
	// Interactivity

	public function autocomplete(Autocomplete|string $type): static
	{
		$this->attribute('autocomplete', $type instanceof Autocomplete ? $type->value : $type);
		return $this;
	}

	public function capitalize(Capitalization|string $type): static
	{
		$this->attribute('autocapitzalize', $type instanceof Capitalization ? $type->value : $type);
		return $this;
	}

	public function inputMode(InputMode|string $mode): static
	{
		$this->attribute('inputmode', $mode instanceof InputMode ? $mode->value : $mode);
		return $this;
	}

}