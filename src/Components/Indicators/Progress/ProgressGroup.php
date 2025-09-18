<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators\Progress;

use Rovota\Embla\Base\Component;

class ProgressGroup extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'progress-group';
	}

}