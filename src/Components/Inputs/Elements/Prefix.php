<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;

class Prefix extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-prefix';
	}

	// -----------------
	// Starters

	public static function text(string $text, array|object $data = []): static
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