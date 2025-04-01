<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Canvas extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'canvas';
	}

	// -----------------
	// Starters

	public static function id(string $identifier): static
	{
		return (new static)->attribute('src', (string) $location);
	}

	public static function sources(array $sources): static
	{
		$last = array_key_last($sources);

		$component = new static;
		$component->attribute('src', Str::beforeLast($sources[$last], ' '));

		if (count($sources) > 1) {
			$component->attribute('srcset', join(', ', $sources));
		}

		return $component;
	}

	// -----------------
	// Appearance

	public function width(int $number): static
	{
		return $this->attribute('width', abs($number));
	}

	public function height(int $number): static
	{
		return $this->attribute('height', abs($number));
	}

}