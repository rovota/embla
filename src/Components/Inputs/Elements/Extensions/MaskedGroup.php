<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements\Extensions;

use Rovota\Embla\Components\Inputs\Elements\Group;

class MaskedGroup extends Group
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-masked';
	}

}