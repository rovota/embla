<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Enums;

use Rovota\Core\Support\Traits\EnumHelpers;

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