<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Elements;

use Rovota\Core\Support\Str;
use Rovota\Embla\Components\Component;

class Note extends Component
{

	public function __construct()
	{
		parent::__construct('input-note');
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

	public static function characterCount(): static
	{
		$component = new static;
		$component->with(Str::translate('Characters:') . ' <charcount></charcount> / <charlimit></charlimit>');
		return $component;
	}

	public static function slugPreview(string $prefix = '/'): static
	{
		$component = new static;
		$component->with(Str::translate('Slug:') . sprintf('%s<span></span>', Str::finish($prefix, $prefix)));
		return $component;
	}

}