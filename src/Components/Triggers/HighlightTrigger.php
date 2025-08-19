<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Triggers;

use Rovota\Embla\Base\Component;

class HighlightTrigger extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'trigger';

		$this->attribute('data-type', 'highlight');
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

	public function modifier(string $value): static
	{
		return $this->attribute('data-class', trim($value));
	}

}