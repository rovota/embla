<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Icon extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-icon';
	}

	// -----------------
	// Content

	public function use(string $icon): static
	{
		return $this->with(icon($icon));
	}

	public function capslock(): static
	{
		return $this->use('arrows.upload')->class('capslock')->attribute('title', Str::translate('Capslock is enabled.'));
	}

}