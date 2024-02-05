<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Appearance\Enums;

use Rovota\Core\Support\Traits\EnumHelpers;

enum AccentColor: string
{
	use EnumHelpers;

	case Default = 'default';
	case Azure = 'azure';
	case Blueberry = 'blueberry';
	case Carolina = 'carolina';
	case Emerald = 'emerald';
	case Lavender = 'lavender';
	case Lime = 'lime';
	case Mint = 'mint';
	case Pineapple = 'pineapple';
	case Raspberry = 'raspberry';
	case Rose = 'rose';
	case Sunrise = 'sunrise';
	case Turquoise = 'turquoise';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			AccentColor::Default => 'Default',
			AccentColor::Azure => 'Azure',
			AccentColor::Blueberry => 'Blueberry',
			AccentColor::Carolina => 'Carolina',
			AccentColor::Emerald => 'Emerald',
			AccentColor::Lavender => 'Lavender',
			AccentColor::Lime => 'Lime',
			AccentColor::Mint => 'Mint',
			AccentColor::Pineapple => 'Pineapple',
			AccentColor::Raspberry => 'Raspberry',
			AccentColor::Rose => 'Rose',
			AccentColor::Sunrise => 'Sunrise',
			AccentColor::Turquoise => 'Turquoise',
		};
	}

}