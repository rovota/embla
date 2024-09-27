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

	public static function use(string $icon): static
	{
		return (new static)->with(icon($icon));
	}

	public static function capslock(): static
	{
		$component = self::use('arrows.upload');
		$component->class('capslock');
		$component->attribute('title', Str::translate('Capslock is enabled.'));
		return $component;
	}

}