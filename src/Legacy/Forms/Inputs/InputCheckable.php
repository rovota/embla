<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs;

interface InputCheckable
{

	public function checkedIf(bool $condition): static;

	public function checked(): static;

	public function unchecked(): static;

}