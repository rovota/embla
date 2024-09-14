<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Typography;

use Rovota\Embla\Legacy\Component;

class Label extends Component
{

	public function __construct()
	{
		parent::__construct('label');
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

	// -----------------
	// Interactivity

	public function for(string $id): static
	{
		$this->attribute('for', $id);
		return $this;
	}

}