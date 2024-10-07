<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class OrderedList extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'ol';
	}

	// -----------------
	// Starters

	public static function withItems(array $items): static
	{
		return (new static)->with($items);
	}

}