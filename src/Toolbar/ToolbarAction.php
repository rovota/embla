<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Toolbar;

use Illuminate\Support\Fluent;
use Illuminate\Support\Traits\Conditionable;

class ToolbarAction extends Fluent
{
	use Conditionable;

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

	public function title(string $title): static
	{
		return $this->set('title', $title);
	}

	// -----------------

	public function dot(string|null $style = null): static
	{
		return $this->set('dot', new Fluent([
			'style' => $style
		]));
	}

}