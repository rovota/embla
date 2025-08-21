<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Inputs\Interfaces\InputMasked;
use Rovota\Embla\Components\Typography\Paragraph;
use Rovota\Embla\Components\Typography\Span;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Support\Str;

class Toggle extends Base implements InputCheckable, InputMasked
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Checkbox);
		}

		$this->value(1);
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

	public function description(string $content, array|object $data = []): static
	{
		return $this->variable('description', Str::translate($content, $data));
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
		$html = '<label class="input-toggle">' . parent::render() . '<content>';

		if ($this->variables->has('label')) {
			$html .= Span::make()->withEscaped($this->variables->get('label'));
		}

		if ($this->variables->has('description')) {
			$html .= Paragraph::make()->withEscaped($this->variables->get('description'));
		}

		return $html . '</content><toggle></toggle></label>';
	}

}