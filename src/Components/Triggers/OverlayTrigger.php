<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Triggers;

use Rovota\Embla\Base\Component;

class OverlayTrigger extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'trigger';

		$this->attribute('data-type', 'overlay');
	}

	// -----------------
	// Starters

	public static function target(string $value): static
	{
		return (new static)->attribute('data-target', route($value));
	}

}