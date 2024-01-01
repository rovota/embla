<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Fields;

use Rovota\Embla\Component;
use Rovota\Embla\Forms\Inputs\Enums\InputType;
use Rovota\Embla\Forms\Inputs\InputCommons;

abstract class Base extends Component
{
	use InputCommons;

	// -----------------

	public function __construct(string $tag = 'input')
	{
		parent::__construct($tag);
	}

	// -----------------

	protected function build(): void
	{
		if ($this->attributes->missing('type') && $this->config->tag === 'input') {
			$this->type(InputType::Text);
		}
	}

}