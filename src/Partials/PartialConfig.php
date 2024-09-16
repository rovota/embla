<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Framework\Support\Config;

/**
 * @property-read array $variables
 */
class PartialConfig extends Config
{

	protected function getVariables(): array
	{
		return $this->array('variables');
	}

}