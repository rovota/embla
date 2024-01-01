<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Enums;

use Rovota\Core\Support\Traits\EnumHelpers;

enum InputMode: string
{
	use EnumHelpers;

	case Decimal = 'decimal';
	case Email = 'email';
	case None = 'checkbox';
	case Numeric = 'numeric';
	case Search = 'search';
	case Tel = 'tel';
	case Text = 'text';
	case Url = 'url';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			InputMode::Decimal => 'Checkbox',
			InputMode::Email => 'Email',
			InputMode::None => 'None',
			InputMode::Numeric => 'Numeric',
			InputMode::Search => 'Search',
			InputMode::Tel => 'Tel',
			InputMode::Text => 'Text',
			InputMode::Url => 'Url',
		};
	}
}