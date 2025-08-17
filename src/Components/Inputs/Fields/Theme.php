<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use BackedEnum;
use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Inputs\Interfaces\InputMasked;
use Rovota\Embla\Components\Inputs\Traits\CreatableFromArray;
use Rovota\Embla\Components\Media\Image;
use Rovota\Embla\Components\Typography\Span;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Support\Str;

class Theme extends Base implements InputCheckable, InputMasked
{
	use CreatableFromArray;

	// -----------------

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Radio);
		}
	}

	// -----------------
	// Starters

	public static function using(BackedEnum|string $theme = 'automatic'): static
	{
		$component = new static;
		$component->value(is_string($theme) ? $theme : $theme->value);
		$component->image(is_string($theme) ? $theme : $theme->value);

		if ($theme instanceof BackedEnum) {
			$component->label(method_exists($theme, 'label') ? $theme->label() : $theme->value);
		} else {
			$component->label($theme);
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

	public function image(string $name): static
	{
		$this->variables->set('image', asset_url('interface/previews/'.$name.'.svg'));
		return $this;
	}

	public function triggerPreview(): static
	{
		return $this->attribute('preview-theme');
	}

	// -----------------

	protected function render(): string
	{
		$html = '<label class="input-theme">'.parent::render().'<content>';

		if ($this->variables->has('image')) {
			$html .= Image::source($this->variables->get('image'))->fallback('Preview');
		}

		if ($this->variables->has('label')) {
			$html .= Span::content($this->variables->get('label'));
		}

		return $html.'</content></label>';
	}

}