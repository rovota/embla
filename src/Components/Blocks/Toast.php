<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Toast extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'toast';
	}

	// -----------------
	// Starters

	public static function createFrom(array $data): static
	{
		$component = new static;
		$component->message($data['message'], $data['parameters'] ?? []);
		$component->type($data['type'] ?? 'auto');

		return $component;
	}

	// -----------------
	// Content

	public function message(string $text, array|object $data = []): static
	{
		return $this->attribute('data-message', Str::translate($text, $data));
	}

	// -----------------
	// Appearance

	public function type(mixed $type = 'auto'): static
	{
		return $this->attribute('data-type', $type);
	}

}