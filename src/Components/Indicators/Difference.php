<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Illuminate\Support\Number;
use Rovota\Embla\Components\Component;
use Rovota\Embla\Data\Colors\Status;

class Difference extends Component
{

	public string $tag = 'span';

	protected function configuration(): void
	{
		$this->class('diff');
	}

	// -----------------
	// Starters

	public static function auto(int|float $value, int $precision = 2): static
	{
		return match (true) {
			$value > 0 => self::positive($value, $precision),
			$value < 0 => self::negative($value, $precision),
			default => self::neutral($value, $precision)
		};
	}

	public static function neutral(int|float $value, int $precision = 2): static
	{
		$value = Number::format(abs($value), $precision);
		return (new static)->withEscaped($value);
	}

	public static function negative(int|float $value, int $precision = 2): static
	{
		$value = Number::format(abs($value), $precision);
		return (new static)->accent(Status::Danger)->withEscaped($value);
	}

	public static function positive(int|float $value, int $precision = 2): static
	{
		$value = Number::format(abs($value), $precision);
		return (new static)->accent(Status::Success)->withEscaped($value);
	}

	// -----------------
	// Content

	public function suffix(string $value = '%'): static
	{
		return $this->withEscaped($value);
	}

}