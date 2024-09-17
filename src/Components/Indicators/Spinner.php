<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Base\Component;

class Spinner extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'spinner';
	}

	// -----------------
	// Appearance

	public function double(): static
	{
		return $this->class('double');
	}

}