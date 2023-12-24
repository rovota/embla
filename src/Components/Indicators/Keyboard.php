<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Components\Component;

class Keyboard extends Component
{

	public function __construct()
	{
		parent::__construct('kbd');
	}

	// -----------------

	public static function key(string $text): static
	{
		$component = new static;
		$component->withText($text);
		return $component;
	}

	public static function sequence(array $keys): static
	{
		$component = new static;
		$component->config->tag = 'span';

		foreach ($keys as $key) {
			$child = Keyboard::key($key);
			$component->with($child);
		}
		return $component;
	}

}