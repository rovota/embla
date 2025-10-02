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

	public function route(string $name): static
	{
		return $this->set('route', $name);
	}

	public function icon(string $icon): static
	{
		return $this->set('icon', $icon);
	}

}