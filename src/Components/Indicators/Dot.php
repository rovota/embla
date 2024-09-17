<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Base\Component;

class Dot extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'dot';
	}

}