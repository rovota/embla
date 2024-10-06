<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Breadcrumbs extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'nav';

		$this->addChild(Anchor::toRoute('homepage')->label('Home'));
	}

	// -----------------

	public function current(string $content): static
	{
		$this->variables->set('current', Str::escape($content));
		return $this;
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->variables->has('current')) {
			$this->addChild(Anchor::toUrl(request()->url())->label($this->variables->get('current')));
		}
	}

	// -----------------

	protected function render(): string
	{
		return '<breadcrumbs><container>'.parent::render().'</container></breadcrumbs>';
	}

}