<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout\Overlay;

use Rovota\Embla\Base\Component;

class Shading extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'shading';
	}

	// -----------------

	public function toggle(string $target): static
	{
		return $this->attribute('data-toggle', $target);
	}

}