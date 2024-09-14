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

	public function type(InputType|string $type): static
	{
		$this->attribute('type', $type instanceof InputType ? $type->value : $type);
		return $this;
	}

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

	public function id(string|int $id): static
	{
		$this->attribute('id', $id);
		return $this;
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if (strlen((string) $value) > 0) {
			$this->attribute('value', $value);
		}
		return $this;
	}

	public function placeholder(string $placeholder): static
	{
		$this->attribute('placeholder', Str::translate($placeholder));
		return $this;
	}

	// -----------------
	// Constraints

	public function required(): static
	{
		$this->attribute('required');
		return $this;
	}

	public function readonly(): static
	{
		$this->attribute('readonly');
		return $this;
	}

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

	public function disabled(): static
	{
		$this->attribute('disabled');
		return $this;
	}

	public function autoFocus(): static
	{
		$this->attribute('autofocus');
		return $this;
	}

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