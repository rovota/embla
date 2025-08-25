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

		$this->addChild(Link::toRoute('homepage')->label('Home'));
	}

	// -----------------

	public function current(string $content): static
	{
		return $this->variable('current', Str::escape($content));
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->variables->has('current')) {
			$this->addChild(Link::toUrl(request()->url())->label($this->variables->get('current')));
		}
	}

	// -----------------

	protected function render(): string
	{
		return '<breadcrumbs><container>' . parent::render() . '</container></breadcrumbs>';
	}

}