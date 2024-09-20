<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class UnorderedList extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'ul';
	}

	// -----------------
	// Starters

	public static function withItems(array $items): static
	{
		$component = new static;
		$component->with($items);

		return $component;
	}

}