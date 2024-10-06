<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Month extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Month);
		}
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if ($value !== null) {
			$this->attribute('value', moment($value)->format('Y-m'));
		}
		return $this;
	}

	// -----------------
	// Constraints

	public function min(mixed $moment): static
	{
		return $this->attribute('min', moment($moment)->format('Y-m'));
	}

	public function max(mixed $moment): static
	{
		return $this->attribute('max', moment($moment)->format('Y-m'));
	}

	public function step(int $months = 1): static
	{
		return $this->attribute('step', abs($months));
	}

}