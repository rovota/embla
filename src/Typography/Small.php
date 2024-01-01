<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Typography;

use Rovota\Embla\Component;

class Small extends Component
{

	public function __construct()
	{
		parent::__construct('small');
	}

	// -----------------
	// Content

	public static function content(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

}