<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Text extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->attribute('type', InputType::Text);
		}
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		return $this->attribute('pattern', $pattern);
	}

	// -----------------
	// Interactivity

	public function slugify(): static
	{
		return $this->attribute('slugify');
	}

}