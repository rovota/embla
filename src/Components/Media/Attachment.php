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

	public function name(string $text, array|object $data = []): static
	{
		return $this->with(new Span()->text($text, $data), 'name');
	}

	// -----------------
	// Automatic

	protected function prepareRender(): void
	{
		if ($this->children->missing('name')) {
			$target = $this->attributes->get('href');
			if ($target !== null) {
				$this->name(Str::afterLast($target, '/'));
			}
		}
	}

}