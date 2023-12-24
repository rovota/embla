<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components;

use Rovota\Core\Support\Config;

/**
 * @property string $tag
 * @property bool $self_closing
 * @property Component|null $parent
 */
final class ComponentConfig extends Config
{

	protected function tag(): string
	{
		return $this->get('tag', 'div');
	}

	protected function selfClosing(): bool
	{
		return $this->bool('self_closing');
	}

	// -----------------

	protected function parent(): Component|null
	{
		return $this->get('parent');
	}

}