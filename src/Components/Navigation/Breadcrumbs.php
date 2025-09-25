<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Components\Component;

class Breadcrumbs extends Component
{

	public string $tag = 'nav';

	protected function configuration(): void
	{
		$this->addChild(new Anchor()->toRoute('homepage')->text('Home'));
	}

	// -----------------

	public function current(string $content): static
	{
		return $this->variable('current', e($content));
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->variables->has('current')) {
			$this->addChild(new Anchor()->to(request()->url())->text($this->variables->get('current')));
		}
	}

	// -----------------

	protected function render(): string
	{
		return '<breadcrumbs><container>' . parent::render() . '</container></breadcrumbs>';
	}

}