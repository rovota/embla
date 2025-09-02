<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Typography\Span;

class Placeholder extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'placeholder';
	}

	// -----------------
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->with(new Span()->text($text, $data), 'text');
	}

	// -----------------
	// Appearance

	public function transparent(): static
	{
		return $this->class('transparent');
	}

	public function thin(): static
	{
		return $this->class('thin');
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->children->missing('text')) {
			$this->with(new Span()->text('There is nothing to show here.'), 'text');
		}
	}

}