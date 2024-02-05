<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Appearance\Enums;

use Rovota\Core\Support\Traits\EnumHelpers;

enum Theme: string
{
	use EnumHelpers;

	case Automatic = 'automatic';
	case Light = 'light';
	case Dark = 'dark';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			Theme::Automatic => 'Automatic',
			Theme::Light => 'Light',
			Theme::Dark => 'Dark',
		};
	}
}