<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Base\Component;

class Keystroke extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'kbd';
	}

	// -----------------
	// Starters

	public static function value(string $value): static
	{
		return (new static)->withEscaped($value);
	}

	public static function sequence(array $keystrokes): static
	{
		$component = new static;
		$component->getConfig()->tag = 'span';

		foreach ($keystrokes as $value) {
			$component->with(Keystroke::value($value));
		}

		return $component;
	}

}