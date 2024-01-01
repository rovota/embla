<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Fields;

use Rovota\Core\Support\Str;
use Rovota\Embla\Forms\Inputs\Enums\InputType;
use Rovota\Embla\Forms\Inputs\InputCheckable;
use Rovota\Embla\Forms\Inputs\InputMasked;
use Rovota\Embla\Typography\Paragraph;
use Rovota\Embla\Typography\Span;

class Panel extends Base implements InputCheckable, InputMasked
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Radio);
		}

		$this->value(1);
	}

	// -----------------
	// Content

	public function label(string $text, array|object $args = []): static
	{
		$text = Str::translate($text, $args);
		$this->variables->set('label', $text);
		$this->ariaLabel($text);
		return $this;
	}

	public function description(string $content, array|object $args = []): static
	{
		$this->variables->set('description', Str::translate($content, $args));
		return $this;
	}

	// -----------------
	// Interactivity

	public function checkbox(): static
	{
		$this->type(InputType::Checkbox);
		return $this;
	}

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
		$html = '<label class="input-panel">'.parent::render().'<indicator></indicator><content>';

		if ($this->variables->has('label')) {
			$html .= Span::content($this->variables->get('label'));
		}

		if ($this->variables->has('description')) {
			$html .= Paragraph::content($this->variables->get('description'));
		}

		return $html.'</content></label>';
	}

}