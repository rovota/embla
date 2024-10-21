<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Colors;

use Rovota\Framework\Support\Traits\EnumHelpers;

enum Accent: string
{
	use EnumHelpers;

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
			Accent::Azure => 'Azure',
			Accent::Blueberry => 'Blueberry',
			Accent::Carolina => 'Carolina',
			Accent::Emerald => 'Emerald',
			Accent::Lavender => 'Lavender',
			Accent::Lime => 'Lime',
			Accent::Mint => 'Mint',
			Accent::Pineapple => 'Pineapple',
			Accent::Raspberry => 'Raspberry',
			Accent::Rose => 'Rose',
			Accent::Sunrise => 'Sunrise',
			Accent::Turquoise => 'Turquoise',
		};
	}

}