<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Fluent;
use Rovota\Embla\Data\Colors\Status;

final class Toast
{

	public static function set(string $message, array $parameters = [], mixed $type = 'auto'): void
	{
		Session::flash('toast', new Fluent([
			'message' => __($message, $parameters),
			'type' => $type,
		]));
	}

	// -----------------

	public static function info(string $message, array $parameters = []): void
	{
		self::set($message, $parameters, Status::Info);
	}

	public static function success(string $message, array $parameters = []): void
	{
		self::set($message, $parameters, Status::Success);
	}

	public static function warning(string $message, array $parameters = []): void
	{
		self::set($message, $parameters, Status::Warning);
	}

	public static function danger(string $message, array $parameters = []): void
	{
		self::set($message, $parameters, Status::Danger);
	}

}