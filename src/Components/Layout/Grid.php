<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout;

use Rovota\Embla\Base\Component;

class Grid extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'grid';
	}

	// -----------------

	public function grid(int $number): static
	{
		$this->class('grid-' . abs($number));
		return $this;
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->classes->contains(fn (string $class) => str_starts_with($class, 'grid-')) === false) {
			$this->class('grid-auto');
		}
	}

}