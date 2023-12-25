<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Fields;

use Rovota\Embla\Components\Forms\Inputs\Elements\OptionGroup;

class Select extends Base
{

	public function __construct()
	{
		parent::__construct('select');
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		foreach ($this->children as $entry) {
			if ($entry instanceof OptionGroup) {
				foreach ($entry->children as $option) {
					if ($option->attributes->get('value') === (string)$value) {
						$option->selected();
					}
				}
			} else {
				if ($entry->attributes->get('value') === (string)$value) {
					$entry->selected();
				}
			}
		}
		return $this;
	}

}