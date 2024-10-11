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
	}

	// -----------------
	// Starters

	public static function source(mixed $location): static
	{
		return (new static)->attribute('src', (string) $location);
	}

	// -----------------
	// Content

	public function fallback(string $text, array|object $data = []): static
	{
		return $this->attribute('alt', Str::translate($text, $data));
	}

}