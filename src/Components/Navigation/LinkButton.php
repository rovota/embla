<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

class LinkButton extends Link
{

	protected function configuration(): void
	{
		parent::configuration();

		$this->class('button');
	}

	// -----------------
	// Content

	public function icon(string $name): static
	{
		return $this->with(icon($name))->class('icon');
	}

	// -----------------
	// Appearance

	public function outlined(): static
	{
		return $this->class('outlined');
	}

	public function link(): static
	{
		return $this->class('link');
	}

	public function large(): static
	{
		return $this->class('large');
	}

}