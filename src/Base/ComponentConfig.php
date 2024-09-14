<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base;

use Rovota\Framework\Support\Config;

/**
 * @property string $tag
 * @property bool $self_closing
 */
final class ComponentConfig extends Config
{

	protected function getTag(): string
	{
		return $this->get('tag', 'div');
	}

	protected function setTag(string $tag): void
	{
		$this->set('tag', trim($tag));
	}

	// -----------------

	protected function getSelfClosing(): bool
	{
		return $this->bool('self_closing');
	}

	protected function setSelfClosing(bool $value): void
	{
		$this->set('self_closing', $value);
	}

}