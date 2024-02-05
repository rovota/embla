<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Elements;

use Rovota\Core\Support\Str;
use Rovota\Embla\Component;

class Icon extends Component
{

	public function __construct()
	{
		parent::__construct('input-icon');
	}

	// -----------------
	// Content

	public static function use(string $icon, string|null $set = null): static
	{
		if (function_exists('icon')) {
			$icon = icon($icon, $set);
		}

		$component = new static;
		$component->with(trim($icon));
		return $component;
	}

	public static function capslock(): static
	{
		$component = self::use('status.capslock-enabled');
		$component->class('capslock');
		$component->attribute('title', Str::translate('Capslock is enabled.'));
		return $component;
	}

}