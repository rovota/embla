<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Inputs\Elements\Extensions\OptionGroup;

class Select extends Base
{

	public function __construct(Component|null $parent = null)
	{
		parent::__construct($parent);

		$this->config->tag = 'select';
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		foreach ($this->children as $entry) {
			if ($entry instanceof OptionGroup) {
				foreach ($entry->children as $option) {
					if ($option->attributes->get('value') === (string) $value) {
						$option->selected();
					}
				}
			} else {
				if ($entry->attributes->get('value') === (string) $value) {
					$entry->selected();
				}
			}
		}

		return $this;
	}

}