<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components;

use BackedEnum;
use Rovota\Core\Structures\Bucket;

trait ComponentAppearance
{

	public Bucket $classes;

	// -----------------

	public function class(string|array $name): static
	{
		foreach (convert_to_array($name) as $key => $value) {
			if (is_numeric($key)) {
				$this->classes->append(trim($value));
			}
			if ($value === true) {
				$this->classes->append(trim((string)$key));
			}
		}

		return $this;
	}

	// -----------------
	// Appearance

	public function detectLightness(): static
	{
		$this->class('detect-lightness');
		return $this;
	}

	public function accent(BackedEnum|string $color): static
	{
		if ($color instanceof BackedEnum) {
			$color = $color->value;
		}
		$this->replaceClassWithPrefix('accent-', 'accent-'.trim($color));
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

	// -----------------
	// Interactivity

	public function selection(string $type): static
	{
		$this->replaceClassWithPrefix('select-', 'select-'.trim($type));
		return $this;
	}

	// -----------------
	// Helpers

	protected function replaceClassWithPrefix(string $prefix, string $replacement): void
	{
		$key = $this->classes->find(function ($class) use ($prefix) {
			return str_starts_with($class, $prefix);
		});

		if ($key !== false) {
			$this->classes->set($key, $replacement);
		} else {
			$this->classes->append($replacement);
		}
	}



}