<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Traits;

use Rovota\Framework\Support\Str;

trait AccessibilityMethods
{

	public function title(string $text, array|object $data = [], bool $aria = false): static
	{
		$translated = Str::translate($text, $data);
		if ($aria === true) {
			$this->attribute('aria-label', Str::escape($translated));
		}

		$this->attribute('title', Str::escape($translated));
		return $this;
	}

	// -----------------

	public function ariaLabel(string $text, array|object $data = []): static
	{
		$translated = Str::translate($text, $data);

		$this->attribute('aria-label', Str::escape($translated));
		return $this;
	}

}