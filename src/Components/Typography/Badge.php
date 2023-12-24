<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Components\Component;

class Badge extends Component
{

	public function __construct()
	{
		parent::__construct('badge');
	}

	// -----------------
	// Content

	public static function label(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

	// -----------------
	// Appearance

	public function subtle(): static
	{
		$this->class('subtle');
		return $this;
	}

}