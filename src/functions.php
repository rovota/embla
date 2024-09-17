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