<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout;

use Rovota\Embla\Components\Component;

class Grid extends Component
{

	public string $tag = 'grid';

	// -----------------

	public function grid(int $number): static
	{
		$this->class('grid-' . abs($number));
		return $this;
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->classes->contains(fn(string $class) => str_starts_with($class, 'grid-')) === false) {
			$this->class('grid-auto');
		}
	}

}