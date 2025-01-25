<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout;

class Gallery extends Grid
{

	protected function configuration(): void
	{
		$this->config->tag = 'gallery';
	}

	// -----------------
	// Appearance

	public function spotlight(): static
	{
		$this->class('spotlight-group');
		return $this;
	}

	// -----------------

	protected function prepareRender(): void
	{
		parent::prepareRender();

		if ($this->classes->contains('spotlight-group')) {
			foreach ($this->children as $child) {
				$child->class('spotlight');
			}
		}
	}

}