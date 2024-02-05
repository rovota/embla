<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Blocks;

use BackedEnum;
use Rovota\Core\Facades\Partial;
use Rovota\Core\Support\Str;
use Rovota\Embla\Component;

class Toast extends Component
{

	public function __construct()
	{
		parent::__construct('toast');
	}

	// -----------------
	// Helpers

	public static function createFrom(array $toast): static
	{
		$component = new static;
		$component->message($toast['message'], $toast['args'] ?? []);
		$component->type($toast['type'] ?? 'auto');
		return $component;
	}

	public static function set(BackedEnum $type, string $message): void
	{
		Partial::addVariable('scripts', 'toast', [
			'type' => $type->value,
			'message' => $message,
		]);
	}

	// -----------------
	// Content

	public function message(string $message, array|object $args = []): static
	{
		$this->attribute('data-message', Str::translate($message, $args));
		return $this;
	}

	// -----------------
	// Appearance

	public function type(BackedEnum|string $type = 'auto'): static
	{
		$this->attribute('data-type', (string) $type);
		return $this;
	}

}