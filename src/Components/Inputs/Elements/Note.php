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
	// Starters

	public static function text(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

	public static function characterCount(): static
	{
		return (new static)->with(Str::translate('Characters: ') . '<charcount></charcount> / <charlimit></charlimit>');
	}

	public static function slugPreview(string $prefix = '/'): static
	{
		return (new static)->with(Str::translate('Slug:') . sprintf('%s<span></span>', Str::finish($prefix, $prefix)));
	}

}