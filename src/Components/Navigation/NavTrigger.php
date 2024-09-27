<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Base\Component;

class NavTrigger extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'nav-trigger';

		$this->attribute('data-class', 'selected');
	}

	// -----------------
	// Starters

	public static function prefix(string $value): static
	{
		return (new static)->attribute('data-prefix', '.' . trim($value));
	}

	// -----------------
	// Content

	public function target(string $value): static
	{
		return $this->attribute('data-item', trim($value));
	}

}