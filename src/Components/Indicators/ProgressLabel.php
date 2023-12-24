<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Core\Support\Number;
use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Typography\Small;
use Rovota\Embla\Components\Typography\Span;

class ProgressLabel extends Component
{

	public function __construct()
	{
		parent::__construct('label');
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->with(Span::content($text, $args));
		return $component;
	}

	public function percentage(int $value): static
	{
		$precision = $this->variables->int('precision');
		$value = Number::format(abs($value), $precision);
		$this->with(Small::content($value.'%'));
		return $this;
	}

	// -----------------
	// Misc
	
	protected function build(): void
	{
		$progress = $this->config->parent->children->first(function (Component $component) {
			return $component instanceof Progress;
		});
		
		if ($progress->attributes->has('value')) {
			$this->percentage($progress->attributes->int('value', 0));
		}
	}

}