<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Traits;

use Illuminate\Support\Facades\Lang;

trait AccessibilityMethods
{

	public function title(string $text, array|object $data = [], bool $aria = false): static
	{
		$translated = Lang::get($text, $data);
		if ($aria === true) {
			$this->attribute('aria-label', e($translated));
		}

		$this->attribute('title', e($translated));
		return $this;
	}

	// -----------------

	public function ariaLabel(string $text, array|object $data = []): static
	{
		$translated = Lang::get($text, $data);

		$this->attribute('aria-label', e($translated));
		return $this;
	}

}