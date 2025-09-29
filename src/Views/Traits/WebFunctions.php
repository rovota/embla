<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views\Traits;

use Illuminate\Support\Fluent;

trait WebFunctions
{

	public function withOverlay(string $target): static
	{
		return $this->with('trigger_overlay', new Fluent([
			'target' => $target,
		]));
	}

	public function withParent(string $action, string|null $value = null): static
	{
		return $this->with('trigger_parent', new Fluent([
			'action' => $action,
			'value' => $value,
		]));
	}

}