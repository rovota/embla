<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Rovota\Embla\Icons\Icon;
use Rovota\Embla\Internal\EmblaManager;
use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Embla\Partials\PartialManager;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Interfaces\Arrayable;

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

if (!function_exists('array_to_classes')) {
	function array_to_classes(Arrayable|array $items): string
	{
		if ($items instanceof Arrayable) {
			$items = $items->toArray();
		}

		$classes = new Basket();

		foreach ($items as $key => $value) {
			if (is_numeric($key)) {
				$classes->append($value);
			}
			if ($value === true) {
				$classes->append((string) $key);
			}
		}

		return $classes->join(' ');
	}
}

if (!function_exists('partial')) {
	function partial(string $template, string|null $class = null): PartialInterface
	{
		return PartialManager::instance()->createPartial($template, $class);
	}
}

// -----------------
// Content

if (!function_exists('icon')) {
	function icon(string $name): Icon|null
	{
		return EmblaManager::instance()->getIconManager()->getIcon($name);
	}
}

// -----------------
// Localization

if (!function_exists('language_iso2')) {
	function language_iso2(): string
	{
		return Language::current()->iso2();
	}
}

if (!function_exists('language_direction')) {
	function language_direction(): string
	{
		return Language::current()->textDirection();
	}
}