<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Components\Component;

class Progress extends Component
{

	public function __construct()
	{
		parent::__construct('progress');
	}

	// -----------------
	// Appearance

	public function max(int|float $number): static
	{
		$this->attribute('max', abs($number));
		return $this;
	}

	public function current(int|float $number): static
	{
		$this->attribute('value', abs($number));
		return $this;
	}

}