<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Number extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Number);
		}
	}

	// -----------------
	// Constraints

	public function min(int|float $number): static
	{
		return $this->attribute('min', $number);
	}

	public function max(int|float $number): static
	{
		return $this->attribute('max', $number);
	}

	public function step(int|float $number): static
	{
		return $this->attribute('step', abs($number));
	}

}