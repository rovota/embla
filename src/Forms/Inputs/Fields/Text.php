<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Fields;

use Rovota\Embla\Forms\Inputs\Enums\InputType;

class Text extends Base
{

	public function __construct()
	{
		parent::__construct();

		if ($this->attributes->missing('type')) {
			$this->type(InputType::Text);
		}
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

	public function slugify(): static
	{
		$this->attribute('slugify');
		return $this;
	}

}