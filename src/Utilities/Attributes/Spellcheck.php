<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Attributes;

use Rovota\Framework\Support\Traits\EnumHelpers;

enum Spellcheck: string
{
	use EnumHelpers;

	case Off = 'off';
	case On = 'on';
	case Default = '';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			Spellcheck::Off => 'Disabled',
			Spellcheck::On => 'Enabled',
			Spellcheck::Default => 'Default',
		};
	}
}