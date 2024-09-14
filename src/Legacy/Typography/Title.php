<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Typography;

use Rovota\Embla\Legacy\Component;

class Title extends Component
{

	public function __construct()
	{
		parent::__construct('h1');
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

}