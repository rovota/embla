<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Data\Colors;

enum Status: string
{

	case Info = 'info';
	case Success = 'success';
	case Warning = 'warning';
	case Danger = 'danger';

}