<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Elements;

use Rovota\Embla\Legacy\Component;

class Suffix extends Component
{

	public function __construct()
	{
		parent::__construct('input-suffix');
	}

	// -----------------
	// Content

	public static function label(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

}