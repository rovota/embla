<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy;

trait ComponentData
{

	// -----------------
	// Common

	public function title(string $title, array|object $args = [], bool $aria = false): static
	{
		$this->attribute('title', Str::translate($title, $args));
		if ($aria === true) {
			$this->ariaLabel($title, $args);
		}
		return $this;
	}

	public function ariaLabel(string $text, array|object $args = []): static
	{
		$this->attribute('aria-label', Str::translate($text, $args));
		return $this;
	}

}