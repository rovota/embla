<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Embla\Components\Forms\Inputs\Enums\InputType;

class Month extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
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
		$this->attribute('min', moment($moment)->format('Y-m'));
		return $this;
	}

	public function max(mixed $moment): static
	{
		$this->attribute('max', moment($moment)->format('Y-m'));
		return $this;
	}

	public function step(int $months = 1): static
	{
		$this->attribute('step', abs($months));
		return $this;
	}

}