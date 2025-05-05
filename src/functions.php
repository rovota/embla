<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Rovota\Embla\Components\Layout\Icons\Icon;
use Rovota\Embla\Embla;
use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Embla\Partials\PartialManager;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Facades\Registry;
use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Interfaces\Arrayable;
use Rovota\Framework\Support\Str;
use Rovota\Framework\Support\Url;

// -----------------
// Templating Utilities

if (!function_exists('parse_objects')) {
	function parse_objects(Arrayable|array $objects): void
	{
		foreach ($objects as $object) {
			if ($object instanceof Stringable) {
				echo $object;
			}
		}
	}
}

if (!function_exists('partial')) {
	function partial(string $template, string|null $class = null): PartialInterface
	{
		return PartialManager::instance()->createPartial($template, $class);
	}
}

if (!function_exists('array_to_classes')) {
	function array_to_classes(Arrayable|array $data): string
	{
		if ($data instanceof Arrayable) {
			$data = $data->toArray();
		}

		$classes = new Basket();

		foreach ($data as $key => $value) {
			if (is_numeric($key)) {
				$classes->append($value);
			}
			if ($value === true) {
				$classes->append((string)$key);
			}
		}

		return trim($classes->join(' '));
	}
}

// -----------------
// Content

if (!function_exists('icon')) {
	function icon(string $name): Icon|null
	{
		return Embla::instance()->getIconManager()->getIcon($name);
	}
}

if (!function_exists('asset_url')) {
	function asset_url(string $file, array $parameters = []): string
	{
		return Url::local('/resources/assets/' . Str::trim($file, '/'), $parameters);
	}
}

// -----------------
// Localization

if (!function_exists('language_iso2')) {
	function language_iso2(): string
	{
		return Language::active()->iso2();
	}
}

if (!function_exists('language_direction')) {
	function language_direction(): string
	{
		return Language::active()->textDirection();
	}
}