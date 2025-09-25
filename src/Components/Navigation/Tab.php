<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Components\Indicators\Badge;

class Tab extends Anchor
{

	public string $tag = 'a';

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