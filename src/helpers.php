<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Illuminate\Support\Carbon;
use Rovota\Embla\Icons\Icon;
use Rovota\Embla\Icons\IconManager;

// -----------------
// Content

if (!function_exists('icon')) {
	function icon(string $name): Icon|null|string
	{
		return app(IconManager::class)->get($name);
	}
}

if (!function_exists('moment')) {
	function moment(mixed $value, DateTimeZone|string|int|null $timezone = null): Carbon
	{
		return new Carbon($value, $timezone);
	}
}