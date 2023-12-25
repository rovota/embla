<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Core\Support\Str;
use Rovota\Embla\Components\Forms\Inputs\Enums\InputType;
use Rovota\Embla\Components\Forms\Inputs\InputCheckable;
use Rovota\Embla\Components\Forms\Inputs\InputMasked;
use Rovota\Embla\Components\Wrappers\Content;

class Radio extends Base implements InputCheckable, InputMasked
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Radio);
		}
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
		$html = '<label class="input-choice">'.parent::render().'<indicator></indicator>';

		if ($this->variables->has('label')) {
			$html .= Content::create()->withText($this->variables->get('label'));
		}

		return $html.'</label>';
	}

}