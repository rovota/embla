<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Rovota\Embla\Utilities\Colors\Status;
use Rovota\Framework\Facades\Cache;

final class Toast
{

	public static function set(string $message, array $parameters = [], mixed $type = 'auto'): void
	{
		Cache::store('session')->set('toast_notification', [
			'message' => $message,
			'parameters' => $parameters,
			'type' => $type,
		]);
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