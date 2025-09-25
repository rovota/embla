<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout\Carousel;

use Rovota\Embla\Components\Component;

class IndicatorList extends Component
{

	public string $tag = 'container';

	// -----------------

	protected function render(): string
	{
		return '<indicators>' . parent::render() . '</indicators>';
	}

}