<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Embla\Components\Forms\Inputs\Enums\InputType;

class Number extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Number);
		}
	}

	// -----------------
	// Constraints

	public function min(int|float $number): static
	{
		$this->attribute('min', abs($number));
		return $this;
	}

	public function max(int|float $number): static
	{
		$this->attribute('max', abs($number));
		return $this;
	}

	public function step(int|float $number): static
	{
		$this->attribute('step', abs($number));
		return $this;
	}

}