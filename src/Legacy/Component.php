<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy;

use Rovota\Embla\Bucket;
use Rovota\Embla\Str;
use Rovota\Framework\Support\Traits\Conditionable;

class Component
{
	use ComponentAppearance;
	use ComponentContent;
	use ComponentData;
	use Conditionable;

	// -----------------

	public ComponentConfig $config;

	// -----------------

	public function __construct(string $tag = 'div')
	{
	}

	// -----------------

	protected function render(): string
	{
		$this->build();

		$html = '<'.$this->config->tag;
		$attributes = $this->getFormattedAttributes();
		$classes = $this->getFormattedClasses();

		if (empty($attributes) === false) {
			$html .= ' '.implode(' ', $attributes);
		}

		if (empty($classes) === false) {
			$html .= ' class="'.implode(' ', $classes).'"';
		}

		if ($this->children->isEmpty()) {
			return $html.($this->config->self_closing ? ' />' : '></'.$this->config->tag.'>');
		}

		return $html.'>'.implode('', $this->children->toArray()).'</'.$this->config->tag.'>';
	}

}