<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms;

use Rovota\Embla\Components\Component;

class Button extends Component
{

	public function __construct()
	{
		parent::__construct('button');

		$this->attribute('type', 'submit');
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if (strlen((string) $value) > 0) {
			$this->attribute('value', $value);
		}
		return $this;
	}

	public function label(string $text): static
	{
		$this->withText($text);
		return $this;
	}

	public function icon(string $icon, string|null $set = null): static
	{
		if (function_exists('icon')) {
			$icon = icon($icon, $set);
		}
		$this->with(trim($icon), 'icon');
		$this->class('icon');
		return $this;
	}

	// -----------------
	// Appearance

	public function outlined(): static
	{
		$this->classes->append('outlined');
		return $this;
	}

	public function link(): static
	{
		$this->classes->append('link');
		return $this;
	}

	// -----------------
	// Interactivity

	public static function name(string $name): static
	{
		$component = new static;
		$component->attribute('name', $name);
		return $component;
	}

	public function disabled(): static
	{
		$this->attribute('disabled');
		return $this;
	}

}