<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Colors;

enum Status: string
{

	case Info = 'info';
	case Success = 'success';
	case Warning = 'warning';
	case Danger = 'danger';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			Status::Info => 'Info',
			Status::Success => 'Success',
			Status::Warning => 'Warning',
			Status::Danger => 'Danger',
		};
	}
}