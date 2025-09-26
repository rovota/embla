<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Fluent;

class Tab extends Fluent
{

	public static function name(string $name): static
	{
		return new static(['name' => $name]);
	}

	// -----------------

	public function route(string $name): static
	{
		return $this->set('route', $name);
	}

	public function title(string $title): static
	{
		return $this->set('title', $title);
	}

	// -----------------

	// TODO: Implement ability to add a badge (Fluent class)

}