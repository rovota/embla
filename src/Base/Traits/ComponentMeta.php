<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Traits;

trait ComponentMeta
{

	public function setScope(): static
	{
		return $this->attribute('itemscope');
	}

	// -----------------

	public function metaProperty(string $name): static
	{
		return $this->attribute('itemprop', $name);
	}

	public function metaType(string $type): static
	{
		return $this->attribute('itemtype', 'https://schema.org/' . $type);
	}

}