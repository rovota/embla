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

	public function label(string $label): static
	{
		return $this->withEscaped($label);
	}

	public function sequence(array $keystrokes): static
	{
		$this->config->tag = 'span';

		foreach ($keystrokes as $key) {
			$this->with(new Keystroke()->label($key));
		}

		return $this;
	}

}