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
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Appearance

	public function subtle(): static
	{
		return $this->class('subtle');
	}

}