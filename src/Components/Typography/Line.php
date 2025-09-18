<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Line extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'hr';
	}

}