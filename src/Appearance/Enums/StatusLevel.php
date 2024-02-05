<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Appearance\Enums;

use Rovota\Core\Support\Traits\EnumHelpers;

enum StatusLevel: string
{
	use EnumHelpers;

	case Danger = 'danger';
	case Info = 'info';
	case Success = 'success';
	case Warning = 'warning';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			StatusLevel::Danger => 'Danger',
			StatusLevel::Info => 'Info',
			StatusLevel::Success => 'Success',
			StatusLevel::Warning => 'Warning',
		};
	}
}