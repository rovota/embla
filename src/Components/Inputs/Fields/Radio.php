<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Inputs\Interfaces\InputMasked;
use Rovota\Embla\Components\Layout\Content;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Support\Str;

class Radio extends Base implements InputCheckable, InputMasked
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Radio);
		}
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

	protected function render(): string
	{
		$html = '<label class="input-choice">' . parent::render() . '<indicator></indicator>';

		if ($this->variables->has('label')) {
			$html .= Content::make()->withEscaped($this->variables->get('label'));
		}

		return $html . '</label>';
	}

}