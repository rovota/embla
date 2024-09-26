<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Base\Component;

class Badge extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'badge';
	}

	// -----------------
	// Content

	public static function label(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

	// -----------------
	// Appearance

	public function subtle(): static
	{
		return $this->class('subtle');
	}

}