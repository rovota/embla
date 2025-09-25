<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Components\Component;

class Keystroke extends Component
{

	public string $tag = 'kbd';

	// -----------------
	// Starters

	public function label(string $label): static
	{
		return $this->withEscaped($label);
	}

	public function sequence(array $keystrokes): static
	{
		$this->tag = 'span';

		foreach ($keystrokes as $key) {
			$this->with(new Keystroke()->label($key));
		}

		return $this;
	}

}