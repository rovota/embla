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
	// Starters

	public static function name(string $name): static
	{
		return (new static)->attribute('name', $name);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if (strlen((string) $value) > 0) {
			$this->attributeEscaped('value', $value);
		}

		return $this;
	}

	public function label(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Interactivity

	public function disabled(): static
	{
		return $this->attribute('disabled');
	}

	// -----------------
	// Appearance

	public function outlined(): static
	{
		return $this->class('outlined');
	}

	public function link(): static
	{
		return $this->class('link');
	}

	public function large(): static
	{
		return $this->class('large');
	}

}