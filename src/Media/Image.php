<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Media;

use Rovota\Core\Support\Str;
use Rovota\Embla\Component;

class Image extends Component
{

	public function __construct()
	{
		parent::__construct('img');

		$this->variable('self_closing', true);
	}

	// -----------------
	// Content

	public static function from(mixed $location): static
	{
		$component = new static;
		$component->attribute('src', (string) $location);
		return $component;
	}

	public function fallback(string $text, array|object $args = []): static
	{
		$this->attribute('alt', Str::translate($text, $args));
		return $this;
	}

}