<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Heading extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'h2';
	}

	// -----------------
	// Starters

	public static function text(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

	// -----------------
	// Appearance

	public function h1(): static
	{
		$this->config->tag = 'h1';
		return $this;
	}

	public function h2(): static
	{
		$this->config->tag = 'h2';
		return $this;
	}

	public function h3(): static
	{
		$this->config->tag = 'h3';
		return $this;
	}

	public function h4(): static
	{
		$this->config->tag = 'h4';
		return $this;
	}

	public function h5(): static
	{
		$this->config->tag = 'h5';
		return $this;
	}

}