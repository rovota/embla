<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Components\Navigation\Anchor;
use Rovota\Embla\Components\Typography\Span;

class Attachment extends Anchor
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
		$this->class('attachment');

		$this->addChild('', 'icon');
		$this->addChild('', 'label');
	}

	// -----------------
	// Content

	public function icon(string $name): static
	{
		return $this->with(icon($name), 'icon');
	}

	public function label(string $text, array|object $data = []): static
	{
		return $this->with(Span::content($text, $data), 'label');
	}

}