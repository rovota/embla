<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout\Carousel;

use Rovota\Embla\Base\Component;

class IndicatorList extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'container';
	}

	// -----------------

	protected function render(): string
	{
		return '<indicators>'.parent::render().'</indicators>';
	}

}