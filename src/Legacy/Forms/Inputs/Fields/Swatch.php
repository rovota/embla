<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Fields;

use BackedEnum;
use Rovota\Core\Support\Str;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\InputType;
use Rovota\Embla\Legacy\Forms\Inputs\InputCheckable;
use Rovota\Embla\Legacy\Forms\Inputs\InputMasked;

class Swatch extends Base implements InputCheckable, InputMasked
{

	public function __construct(bool $live_preview = false)
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Radio);
		}

		if ($live_preview === true) {
			$this->attribute('preview-accent');
		}
	}

	// -----------------

	public static function fromArray(array $items, bool $live_preview = false): array
	{
		$components = [];
		/** @var array<int, BackedEnum> $items */
		foreach ($items as $item) {
			$components[] = Swatch::using($item, $live_preview);
		}
		return $components;
	}

	// -----------------
	// Content

	public static function using(BackedEnum|string $color = 'auto', bool $live_preview = false): static
	{
		$component = new static($live_preview);
		$component->value(is_string($color) ? $color : $color->value);
		$component->accent($color);

		if ($color instanceof BackedEnum) {
			$component->label(method_exists($color, 'label') ? $color->label() : $color->value);
		} else {
			$component->label($color);
		}

		return $component;
	}

	public function label(string $text, array|object $args = []): static
	{
		$text = Str::translate($text, $args);
		$this->variables->set('label', $text);
		$this->ariaLabel($text);
		return $this;
	}

	// -----------------
	// Appearance

	public function accent(BackedEnum|string $color = 'auto'): static
	{
		if ($color instanceof BackedEnum) {
			$color = $color->value;
		}
		$this->variables->set('accent', 'accent-'.trim($color));
		return $this;
	}

	// -----------------
	// Interactivity

	public function checkedIf(bool $condition): static
	{
		if ($condition === true) {
			$this->attribute('checked');
		} else {
			$this->attributes->remove('checked');
		}
		return $this;
	}

	public function checked(): static
	{
		$this->attribute('checked');
		return $this;
	}

	public function unchecked(): static
	{
		$this->attributes->remove('checked');
		return $this;
	}

	// -----------------

	protected function render(): string
	{
		$html = '<label class="input-swatch';

		if ($this->variables->has('accent')) {
			$html .= ' '.$this->variables->get('accent');
			$html .= ' detect-lightness"';
		} else {
			$html .= '"';
		}

		if ($this->variables->has('label')) {
			$html .= ' title="'.$this->variables->get('label').'"';
		}

		return $html.'>'.parent::render().'<checkmark></checkmark></label>';
	}

}