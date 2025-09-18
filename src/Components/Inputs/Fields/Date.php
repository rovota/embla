<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Date extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Date);
		}
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if ($value !== null) {
			$this->attribute('value', moment($value)->format('Y-m-d'));
		}
		return $this;
	}

	// -----------------
	// Constraints

	public function min(mixed $moment): static
	{
		return $this->attribute('min', moment($moment)->format('Y-m-d'));
	}

	public function max(mixed $moment): static
	{
		return $this->attribute('max', moment($moment)->format('Y-m-d'));
	}

	public function step(int $days = 1): static
	{
		return $this->attribute('step', abs($days));
	}

}