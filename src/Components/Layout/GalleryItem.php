<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout;

use Rovota\Embla\Components\Media\Image;
use Rovota\Embla\Components\Navigation\Link;
use Rovota\Framework\Support\Str;

class GalleryItem extends Link
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
	}

	// -----------------
	// Appearance

	public function spotlight(): static
	{
		$this->class('spotlight');
		return $this;
	}

	// -----------------
	// Content

	public function caption(string $text, array|object $data = []): static
	{
		return $this->attribute('caption', Str::translate($text, $data));
	}

	public function description(string $text, array|object $data = []): static
	{
		return $this->attribute('data-description', Str::translate($text, $data));
	}

	// -----------------

	protected function prepareRender(): void
	{
		foreach ($this->children as $child) {
			if ($child instanceof Image) {
				if ($child->attributes->missing('alt')) {
					$child->attribute('alt', $this->attributes->get('caption', ''));
				}

				if ($child->attributes->has('src') && $this->attributes->missing('href')) {
					$this->attribute('href', $child->attributes->get('src'));
				}
			}
		}
	}

}