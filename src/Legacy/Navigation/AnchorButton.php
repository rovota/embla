<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Navigation;

use function Rovota\Embla\Iconography\icon;

class AnchorButton extends Anchor
{

	public function __construct()
	{
		parent::__construct();
		
		$this->classes->append('button');
	}

	// -----------------
	// Content

	public function icon(string $icon, string|null $set = null): static
	{
		if (function_exists('Rovota\Embla\Iconography\icon')) {
			$icon = icon($icon, $set);
		}
		$this->with(trim($icon), 'icon');
		$this->class('icon');
		return $this;
	}

	// -----------------
	// Appearance

	public function outlined(): static
	{
		$this->classes->append('outlined');
		return $this;
	}

	public function link(): static
	{
		$this->classes->append('link');
		return $this;
	}

}