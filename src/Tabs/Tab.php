<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;

class Tab extends Fluent
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

	public function label(string $label): static
	{
		return $this->set('label', $label);
	}

	// -----------------

	public function badge($text = null, $args = [], string|null $style = null): static
	{
		return $this->set('badge', new Fluent([
			'text' => $text,
			'args' => $args,
			'style' => $style
		]));
	}

}