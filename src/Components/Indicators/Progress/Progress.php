<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators\Progress;

use Rovota\Embla\Base\Component;

class Progress extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'progress';
	}

	// -----------------
	// Appearance

	public function total(int|float $number): static
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