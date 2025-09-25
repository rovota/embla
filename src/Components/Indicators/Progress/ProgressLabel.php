<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators\Progress;

use Illuminate\Support\Number;
use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Typography\Label;
use Rovota\Embla\Components\Typography\Small;

class ProgressLabel extends Label
{

	// -----------------
	// Content

	public function percentage(int $value): static
	{
		$precision = $this->variables->get('precision');
		$suffix = $this->variables->get('suffix', '%');

		$value = Number::format(abs($value), $precision);
		return $this->with(new Small()->text($value . $suffix));
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
		/** @var Progress $progress */
		$progress = $this->parent->children->first(function (Component $component) {
			return $component instanceof Progress;
		});

		if ($progress !== null) {
			if ($progress->attributes->has('max') && $this->variables->get('suffix') === '/') {
				$this->suffix(' / ' . $progress->attributes->get('max'));
			}
			if ($progress->attributes->has('value')) {
				$this->percentage($progress->attributes->get('value', 0));
			}
		}
	}

}