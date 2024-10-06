<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\Autocomplete;
use Rovota\Embla\Utilities\Attributes\InputMode;
use Rovota\Embla\Utilities\Attributes\InputType;

class OneTimeCode extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Text);
		}

		$this->autocomplete(Autocomplete::OneTimeCode);
		$this->inputMode(InputMode::Numeric);
	}

	// -----------------
	// Constraints

	public function length(int $number): static
	{
		$this->maxLength($number);
		$this->attribute('pattern', '[0-9]{'.abs($number).'}');
		$this->placeholder(str_repeat('0', $number));
		return $this;
	}

}