<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Colors;

enum Theme: string
{

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