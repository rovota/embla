<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Image extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'img';
		$this->config->self_closing = true;
		
		$this->decoding('async');
	}

	// -----------------
	// Starters

	public static function asset(string $target): static
	{
		return (new static)->attribute('src', asset_url($target));
	}

	public static function source(mixed $location): static
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
	// Content

	public function fallback(string $text, array|object $data = []): static
	{
		return $this->attribute('alt', Str::translate($text, $data));
	}

	// -----------------
	// Behavior

	public function lazyLoad(): static
	{
		return $this->attribute('loading', 'lazy');
	}

	public function eagerLoad(): static
	{
		return $this->attribute('loading', 'eager');
	}

	public function decoding(string $mode): static
	{
		return $this->attribute('decoding', $mode);
	}

}