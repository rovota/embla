<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout;

use Rovota\Embla\Base\Component;

class Container extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'container';
	}

}