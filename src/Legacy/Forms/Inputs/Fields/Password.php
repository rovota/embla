<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Fields;

use Rovota\Embla\Legacy\Forms\Inputs\Enums\Autocomplete;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\Capitalization;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\InputType;

class Password extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Password);
		}

		$this->capitalize(Capitalization::Off);
		$this->attribute('autocorrect', 'off');
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		$this->attribute('pattern', $pattern);
		return $this;
	}

	// -----------------
	// Interactivity

	public function new(): static
	{
		$this->autocomplete(Autocomplete::NewPassword);
		return $this;
	}

	public function current(): static
	{
		$this->autocomplete(Autocomplete::CurrentPassword);
		return $this;
	}

}