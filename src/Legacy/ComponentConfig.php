<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy;

use Rovota\Framework\Support\Config;

/**
 * @property-read string $tag
 * @property-read bool $self_closing
 * @property-read Component|null $parent
 */
final class ComponentConfig extends Config
{

	protected function getTag(): string
	{
		return $this->get('tag', 'div');
	}

	protected function getSelfClosing(): bool
	{
		return $this->bool('self_closing');
	}

	// -----------------

	protected function getParent(): Component|null
	{
		return $this->get('parent');
	}

}