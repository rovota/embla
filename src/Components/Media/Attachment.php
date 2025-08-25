<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Media;

use Rovota\Embla\Components\Navigation\Link;
use Rovota\Embla\Components\Typography\Span;
use Rovota\Framework\Support\Str;

class Attachment extends Link
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
		$this->class('attachment');

		$this->addChild('', 'icon');
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

	// -----------------
	// Automatic

	protected function prepareRender(): void
	{
		if ($this->children->missing('label')) {
			$target = $this->attributes->get('href');
			if ($target !== null) {
				$this->label(Str::afterLast($target, '/'));
			}
		}
	}

}