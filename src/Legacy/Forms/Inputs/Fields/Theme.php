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
use Rovota\Embla\Legacy\Media\Image;
use Rovota\Embla\Legacy\Typography\Span;
use function Rovota\Embla\Forms\Inputs\Fields\asset_url;

class Theme extends Base implements InputCheckable, InputMasked
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Radio);
		}

		$this->attribute('preview-theme');
	}

	// -----------------

	public static function fromArray(array $items): array
	{
		$components = [];
		/** @var array<int, Theme> $items */
		foreach ($items as $item) {
			$components[] = Theme::using($item);
		}
		return $components;
	}

	// -----------------
	// Content

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

	public function label(string $text, array|object $args = []): static
	{
		$text = Str::translate($text, $args);
		$this->variables->set('label', $text);
		$this->ariaLabel($text);
		return $this;
	}

	public function image(string $name): static
	{
		$this->variables->set('image', asset_url('theme/interface/previews/'.$name.'.svg'));
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
		$html = '<label class="input-theme">'.parent::render().'<content>';

		if ($this->variables->has('image')) {
			$html .= Image::from($this->variables->get('image'))->fallback('Preview');
		}

		if ($this->variables->has('label')) {
			$html .= Span::content($this->variables->get('label'));
		}

		return $html.'</content></label>';
	}

}