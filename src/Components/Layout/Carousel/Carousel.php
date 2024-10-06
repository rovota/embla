<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout\Carousel;

use Rovota\Embla\Base\Component;

class Carousel extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'carousel';
	}

}