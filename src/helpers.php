<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

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