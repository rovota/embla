<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Week extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Week);
		}
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if ($value !== null) {
			$this->attribute('value', moment($value)->format('Y-\WW'));
		}
		return $this;
	}

	// -----------------
	// Constraints

	public function min(mixed $moment): static
	{
		return $this->attribute('min', moment($moment)->format('Y-\WW'));
	}

	public function max(mixed $moment): static
	{
		return $this->attribute('max', moment($moment)->format('Y-\WW'));
	}

	public function step(int $weeks = 1): static
	{
		return $this->attribute('step', abs($weeks));
	}

}