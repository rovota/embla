<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Framework\Support\Config;

class PartialConfig extends Config
{

	public array $variables {
		get => $this->array('variables');
	}

}