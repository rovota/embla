<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use BackedEnum;
use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Inputs\Interfaces\InputMasked;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Support\Arr;
use Rovota\Framework\Support\Str;

class Swatch extends Base implements InputCheckable, InputMasked
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Radio);
		}
	}

	// -----------------
	// Starters

	public static function fromArray(array $items, array $options = []): array
	{
		$components = [];
		/** @var array<int, BackedEnum|string> $items */
		foreach ($items as $item) {
			$components[] = Swatch::using($item)->when(empty($options) === false, function (Swatch $component) use ($options) {
				foreach ($options as $option => $value) {
					if (is_int($option)) {
						$option = $value;
					}
					$component->{Str::camel($option)}(...Arr::from($value));
				}
			});
		}
		return $components;
	}

	public static function using(mixed $color = 'auto'): static
	{
		$component = new static;
		$component->value(is_string($color) ? $color : $color->value);
		$component->accent($color);

		if ($color instanceof BackedEnum) {
			$component->label(method_exists($color, 'label') ? $color->label() : $color->value);
		} else {
			$component->label($color);
		}

		return $component;
	}

	// -----------------
	// Content

	public function label(string $text, array|object $data = []): static
	{
		$text = Str::translate($text, $data);
		$this->variables->set('label', $text);
		$this->ariaLabel($text);
		return $this;
	}

	// -----------------
	// Interactivity

	public function checkbox(): static
	{
		return $this->type(InputType::Checkbox);
	}

	public function checkedIf(bool $condition): static
	{
		return $condition ? $this->checked() : $this->unchecked();
	}

	public function checked(): static
	{
		return $this->attribute('checked');
	}

	public function unchecked(): static
	{
		return $this->withoutAttribute('checked');
	}

	// -----------------
	// Appearance

	public function accent(mixed $color = 'auto'): static
	{
		if ($color instanceof BackedEnum) {
			$color = $color->value;
		}
		return $this->variable('accent', 'accent-'.trim($color));
	}

	public function triggerPreview(): static
	{
		return $this->attribute('preview-accent');
	}

	// -----------------

	protected function render(): string
	{
		$html = '<label class="input-swatch';

		if ($this->variables->has('accent')) {
			$html .= ' '.$this->variables->get('accent').' detect-lightness';
		}

		$html .= '"';

		if ($this->variables->has('label')) {
			$html .= ' title="'.$this->variables->get('label').'"';
		}

		return $html.'>'.parent::render().'<checkmark></checkmark></label>';
	}

}