<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Embla\Components\Forms\Inputs\Enums\Autocomplete;
use Rovota\Embla\Components\Forms\Inputs\Enums\InputType;

class OneTimeCode extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Text);
		}

		$this->autocomplete(Autocomplete::OneTimeCode);
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