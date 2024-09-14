<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Indicators;

use Rovota\Core\Support\Number;
use Rovota\Embla\Legacy\Component;

class Difference extends Component
{

	public function __construct()
	{
		parent::__construct('span');

		$this->class('diff');
	}

	// -----------------
	// Content

	public static function auto(int|float $value, int $precision = 2): static
	{
		return match(true) {
			$value > 0 => Difference::positive($value, $precision),
			$value < 0 => Difference::negative($value, $precision),
			default => Difference::neutral($value, $precision),
		};
	}

	public static function neutral(int|float $value, int $precision = 2): static
	{
		$component = new static;
		$component->withText(Number::format(abs($value), $precision));
		return $component;
	}

	public static function negative(int|float $value, int $precision = 2): static
	{
		$component = new static;
		$component->accent('danger');
		$component->withText(Number::format(abs($value), $precision));
		return $component;
	}

	public static function positive(int|float $value, int $precision = 2): static
	{
		$component = new static;
		$component->accent('success');
		$component->withText(Number::format(abs($value), $precision));
		return $component;
	}

}