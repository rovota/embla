<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;

class TabAction extends Fluent
{
	use Conditionable;

	// -----------------

	public static function name(string $name): static
	{
		return new static(['name' => $name]);
	}

	// -----------------

	public function route(string $name, array $parameters = []): static
	{
		return $this->set('route', new Fluent([
			'name' => $name,
			'parameters' => $parameters,
		]));
	}

	public function icon(string $icon): static
	{
		return $this->set('icon', $icon);
	}

}