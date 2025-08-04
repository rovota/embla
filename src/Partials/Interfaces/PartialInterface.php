<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials\Interfaces;

use Rovota\Embla\Partials\PartialConfig;

interface PartialInterface
{

	public function __toString(): string;

	// -----------------

	public function with(array|string $name, mixed $value = null): static;

	public function getVariables(): array;

}