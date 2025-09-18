<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Rovota\Embla\Icons\Icon;
use Rovota\Embla\Icons\IconManager;

// -----------------
// Templating Utilities

if (!function_exists('array_to_classes')) {
	function array_to_classes(Arrayable|array $data): string
	{
		if ($data instanceof Arrayable) {
			$data = $data->toArray();
		}

		$classes = new Collection();

		foreach ($data as $key => $value) {
			if (is_numeric($key)) {
				$classes->add($value);
			}
			if ($value === true) {
				$classes->add((string)$key);
			}
		}

		return trim($classes->join(' '));
	}
}

// -----------------
// Content

if (!function_exists('icon')) {
	function icon(string $name): Icon|null|string
	{
		return app(IconManager::class)->getIcon($name);
	}
}