<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Colors;

enum Status: string
{

	case Danger = 'danger';
	case Info = 'info';
	case Success = 'success';
	case Warning = 'warning';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			Status::Danger => 'Danger',
			Status::Info => 'Info',
			Status::Success => 'Success',
			Status::Warning => 'Warning',
		};
	}
}