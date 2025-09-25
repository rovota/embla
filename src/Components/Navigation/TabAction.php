<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

class TabAction extends Anchor
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

	public function icon(string $name): static
	{
		return $this->with(icon($name))->class('icon');
	}

}