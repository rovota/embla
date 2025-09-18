<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Facades\Cache;
use Rovota\Framework\Facades\Storage;
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

	public static function file(string $location, string|null $disk = null, int|null $retention = null): static
	{
		$target = Cache::remember('image:' . $location, function () use ($location, $disk) {
			return Storage::disk($disk)->file($location)?->url;
		}, $retention);

		return (new static)->when($target !== null, function (Component $component) use ($target) {
			$component->attribute('src', $target);
		});
	}

	public static function asset(string $target): static
	{
		return (new static)->attribute('src', asset_url($target));
	}

	public static function source(mixed $location): static
	{
		return (new static)->attribute('src', (string)$location);
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