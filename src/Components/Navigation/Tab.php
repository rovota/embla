<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Components\Indicators\Badge;

class Tab extends Link
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
	}

	// -----------------
	// Data

	public function for(string $name): static
	{
		return $this->class('tab-' . $name);
	}

	// -----------------
	// Content

	public function badge(string $text, array|object $data = [], mixed $accent = null): static
	{
		$badge = new Badge()->text($text, $data)->when($accent !== null, function ($badge) use ($accent) {
			$badge->accent($accent);
		});

		return $this->with($badge);
	}

}