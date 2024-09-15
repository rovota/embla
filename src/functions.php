<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

use Rovota\Embla\Icons\Icon;
use Rovota\Embla\Services\EmblaManager;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Interfaces\Arrayable;

// -----------------
// Templating Utilities

function parse_objects(Arrayable|array $objects): void
{
	foreach ($objects as $object) {
		if ($object instanceof Stringable) {
			echo $object;
		}
	}
}

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

// -----------------
// Content

function icon(string $name): Icon|null
{
	return EmblaManager::instance()->getIconManager()->getIcon($name);
}

// -----------------
// Localization

function language_iso2(): string
{
	return Language::current()->iso2();
}

function language_direction(): string
{
	return Language::current()->textDirection();
}