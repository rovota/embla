<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\Autocomplete;
use Rovota\Embla\Utilities\Attributes\Capitalization;
use Rovota\Embla\Utilities\Attributes\InputType;

class Password extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->attribute('type', InputType::Password);
		}

		$this->capitalize(Capitalization::Off);
		$this->attribute('autocorrect', 'off');
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		return $this->attribute('pattern', $pattern);
	}

	// -----------------
	// Interactivity

	public function new(): static
	{
		return $this->autocomplete(Autocomplete::NewPassword);
	}

	public function current(): static
	{
		return $this->autocomplete(Autocomplete::CurrentPassword);
	}

}