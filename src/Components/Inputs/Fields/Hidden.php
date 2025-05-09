<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Hidden extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Hidden);
		}
	}

	// -----------------
	// Shortcuts

	public function renderTimestamp(): static
	{
		return $this->name('render_timestamp')->value(microtime(true));
	}

}