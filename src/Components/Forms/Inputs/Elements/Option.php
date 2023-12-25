<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Elements;

use Rovota\Core\Database\Model;
use Rovota\Embla\Components\Component;

class Option extends Component
{

	public function __construct()
	{
		parent::__construct('option');
	}

	// -----------------
	// Misc

	public static function default(string|null $label = null, array|object $args = []): static
	{
		$component = new static;
		$component->withText($label ?? '---', $args);
		$component->selected();
		return $component;
	}

	// -----------------
	// Content

	public static function label(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

	public static function labelFromModel(Model $model): static
	{
		$component = new static;
		$component->withText((string) $model);
		return $component;
	}

	public function value(string $value): static
	{
		$this->attribute('value', $value);
		return $this;
	}

	// -----------------
	// Interactivity

	public function selected(): static
	{
		$this->attribute('selected');
		return $this;
	}

	public function disabled(): static
	{
		$this->attribute('disabled');
		return $this;
	}

}