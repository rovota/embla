<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Traits;

use BackedEnum;
use Rovota\Embla\Components\Inputs\Fields\Base;
use Rovota\Framework\Support\Arr;
use Rovota\Framework\Support\Str;

trait CreatableFromArray
{

	public static function fromArray(array $items, array $options = []): array
	{
		$components = [];
		/** @var array<int, BackedEnum|string> $items */
		foreach ($items as $item) {
			$components[] = static::using($item)->when(empty($options) === false, function (Base $component) use ($options) {
				foreach ($options as $option => $value) {
					if (is_int($option)) {
						$component->{Str::camel($value)}();
						continue;
					}

					if (is_array($value) && array_is_list($value)) {
						$component->{Str::camel($option)}(...$value);
						continue;
					}

					if (is_array($value) && array_is_list($value) === false) {
						foreach ($value as $key => $data) {
							$component->{Str::camel($option)}($key, $data);
						}
						continue;
					}


					$component->{Str::camel($option)}(...Arr::from($value));
				}
			});
		}
		return $components;
	}

}