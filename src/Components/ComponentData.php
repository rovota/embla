<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components;

use Rovota\Core\Structures\Bucket;
use Rovota\Core\Support\Str;

trait ComponentData
{

	public Bucket $variables;

	public Bucket $attributes;

	// -----------------

	public function variable(array|string $name, mixed $value = null): static
	{
		$variables = is_array($name) ? $name : [$name => $value];
		foreach ($variables as $name => $value) {
			$this->variables->set($name, $value);
		}
		return $this;
	}

	// -----------------

	public function attribute(string|array $name, string|null $value = null): static
	{
		$attributes = is_array($name) ? $name : [$name => $value];
		foreach ($attributes as $name => $value) {
			$this->attributes->set($name, trim($value ?? ''));
		}
		return $this;
	}

	// -----------------
	// Common

	public function title(string $title, array|object $args = [], bool $aria = false): static
	{
		$this->attribute('title', Str::translate($title, $args));
		if ($aria === true) {
			$this->ariaLabel($title, $args);
		}
		return $this;
	}

	public function ariaLabel(string $label, array|object $args = []): static
	{
		$this->attribute('aria-label', __($label, $args));
		return $this;
	}

}