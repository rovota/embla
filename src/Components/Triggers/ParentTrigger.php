<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Triggers;

use Rovota\Embla\Base\Component;

class ParentTrigger extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'trigger';

		$this->attribute('data-type', 'parent');
	}

	// -----------------
	// Starters

	public static function message(string $action, string|null $value = null): static
	{
		return (new static)->attribute('data-message', 'parent:' . $action . ($value ? ':' . $value : ''));
	}

}