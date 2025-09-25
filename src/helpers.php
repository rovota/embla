<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Carbon\Carbon;
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
		return app(IconManager::class)->get($name);
	}
}

if (!function_exists('moment')) {
	function moment(mixed $value, DateTimeZone|string|int|null $timezone = null): Carbon
	{
		return new Carbon($value, $timezone);
	}
}

// -----------------
// Data Conversion

if (!function_exists('convert_to_array')) {
	function convert_to_array(mixed $value): array
	{
		return match (true) {
			$value === null => [],
			is_array($value) => $value,
			$value instanceof Arrayable => $value->toArray(),
			$value instanceof JsonSerializable => convert_to_array($value->jsonSerialize()),
			default => [$value],
		};
	}
}