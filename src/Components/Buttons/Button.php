<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Buttons;

use Rovota\Embla\Base\Component;

class Button extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'button';

		$this->attribute('type', 'submit');
	}

	// -----------------
	// Data

	public function name(string $name): static
	{
		return $this->attribute('name', $name);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if (strlen((string)$value) > 0) {
			$this->attribute('value', $value);
		}

		return $this;
	}

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Appearance

	public function outlined(): static
	{
		return $this->class('outlined');
	}

	public function minimal(): static
	{
		return $this->class('link');
	}

	public function large(): static
	{
		return $this->class('large');
	}

}