<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy;

use BackedEnum;

trait ComponentAppearance
{

	// -----------------
	// Appearance

	public function detectLightness(): static
	{
		$this->class('detect-lightness');
		return $this;
	}

	public function accent(BackedEnum|string $color = 'auto'): static
	{
		if ($color instanceof BackedEnum) {
			$color = $color->value;
		}
		$this->replaceClassWithPrefix('accent-', 'accent-'.trim($color));
		$this->detectLightness();
		return $this;
	}

	public function marginTop(int $number): static
	{
		$this->replaceClassWithPrefix('mt-', 'mt-'.abs($number));
		return $this;
	}

	public function marginBottom(int $number): static
	{
		$this->replaceClassWithPrefix('mb-', 'mb-'.abs($number));
		return $this;
	}

	public function paddingTop(int $number): static
	{
		$this->replaceClassWithPrefix('pt-', 'pt-'.abs($number));
		return $this;
	}

	public function paddingBottom(int $number): static
	{
		$this->replaceClassWithPrefix('pb-', 'pb-'.abs($number));
		return $this;
	}

	// -----------------
	// Interactivity

	public function selection(string $type): static
	{
		$this->replaceClassWithPrefix('select-', 'select-'.trim($type));
		return $this;
	}

}