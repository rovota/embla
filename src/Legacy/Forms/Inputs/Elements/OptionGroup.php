<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Elements;

use Rovota\Core\Support\Str;
use Rovota\Embla\Legacy\Component;

class OptionGroup extends Component
{

	public function __construct()
	{
		parent::__construct('optgroup');
	}

	// -----------------
	// Content

	public static function label(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->attribute('label', Str::translate($text, $args));
		return $component;
	}

}