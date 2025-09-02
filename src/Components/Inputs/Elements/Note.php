<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Note extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-note';
	}

	// -----------------
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	public function characterCount(): static
	{
		return $this->with(Str::translate('Characters:') . ' <charcount></charcount> / <charlimit></charlimit>');
	}

	public function slugPreview(string $prefix = '/'): static
	{
		return $this->with(Str::translate('Slug:') . sprintf('%s<span></span>', Str::finish($prefix, $prefix)));
	}

}