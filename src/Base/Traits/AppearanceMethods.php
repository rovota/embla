<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Traits;

use BackedEnum;

trait AppearanceMethods
{

	public function detectLightness(): static
	{
		$this->class('detect-lightness');
		return $this;
	}

	// -----------------

	public function accent(mixed $color = 'auto'): static
	{
		if ($color === null) {
			$color = 'auto';
		}

		if ($color instanceof BackedEnum) {
			$color = $color->value;
		}

		$this->replaceClassWithPrefix('accent-', 'accent-' . trim($color));
		$this->detectLightness();

		return $this;
	}

	// -----------------

	public function selection(string $type): static
	{
		$this->replaceClassWithPrefix('select-', 'select-' . trim($type));
		return $this;
	}

	// -----------------

	public function marginTop(int $number): static
	{
		$this->replaceClassWithPrefix('mt-', 'mt-' . abs($number));
		return $this;
	}

	public function marginBottom(int $number): static
	{
		$this->replaceClassWithPrefix('mb-', 'mb-' . abs($number));
		return $this;
	}

	public function paddingTop(int $number): static
	{
		$this->replaceClassWithPrefix('pt-', 'pt-' . abs($number));
		return $this;
	}

	public function paddingBottom(int $number): static
	{
		$this->replaceClassWithPrefix('pb-', 'pb-' . abs($number));
		return $this;
	}

	// -----------------

	public function disabled(): static
	{
		return $this->attribute('disabled');
	}

}