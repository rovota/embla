<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators\Progress;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Typography\Small;
use Rovota\Embla\Components\Typography\Span;
use Rovota\Framework\Support\Number;

class ProgressLabel extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'label';
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $data = []): static
	{
		return (new static)->with(Span::content($text, $data));
	}

	public function percentage(int $value): static
	{
		$precision = $this->variables->int('precision');
		$suffix = $this->variables->string('suffix', '%');

		$value = Number::format(abs($value), $precision);
		return $this->with(Small::content($value . $suffix));
	}

	// -----------------
	// Appearance

	public function precision(int $precision = 0): static
	{
		return $this->variable('precision', $precision);
	}

	public function suffix(string $value = '%'): static
	{
		return $this->variable('suffix', $value);
	}

	public function valueOfTotal(): static
	{
		return $this->variable('suffix', '/');
	}

	// -----------------
	// Misc

	protected function prepareRender(): void
	{
		$progress = $this->parent->children->first(function (Component $component) {
			return $component instanceof Progress;
		});

		if ($progress !== null) {
			if ($progress->attributes->has('max') && $this->variables->get('suffix') === '/') {
				$this->suffix(' / ' . $progress->attributes->get('max'));
			}
			if ($progress->attributes->has('value')) {
				$this->percentage($progress->attributes->int('value', 0));
			}
		}
	}

}