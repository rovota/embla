<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Base\Component;

class Canvas extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'canvas';
	}

	// -----------------
	// Appearance

	public function width(int $number): static
	{
		return $this->attribute('width', abs($number));
	}

	public function height(int $number): static
	{
		return $this->attribute('height', abs($number));
	}

}