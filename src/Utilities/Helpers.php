<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities;

use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Interfaces\Arrayable;
use Stringable;

final class Helpers
{

	protected function __construct()
	{
	}

	// -----------------

	public static function injectObjects(Arrayable|array $objects): void
	{
		foreach ($objects as $object) {
			if ($object instanceof Stringable) {
				echo $object;
			}
		}
	}

	// -----------------

	public static function arrayToClasses(Arrayable|array $items): string
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