<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Interfaces;

interface InputCheckable
{

	public function checkedIf(bool $condition): static;

	public function checked(): static;

	public function unchecked(): static;

}