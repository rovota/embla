<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Navigation\Anchor;

class Pagination extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'pagination';
	}

	// -----------------
	// Content

	public function pages(int $number): static
	{
		return $this->variable('page_count', $number);
	}

	// -----------------

	protected function prepareRender(): void
	{
		$page_count = $this->variables->int('page_count');

		if ($page_count > 1) {

			$current = request()->int('page', 1);
			$url = request()->url();

			// -----------------

			if ($current > 1) {
				$this->with([
					Anchor::toUrl($url->withParameter('page', $current - 1))->with(icon('arrows.chevron-left'))->class('icon')
				]);
			}

			// -----------------

			$pages = array_fill(1, $page_count, 0);

			foreach ($pages as $number => $value) {
				$this->with([
					Anchor::toUrl($url->withParameter('page', $number))->with($number)->when($current === $number,function (Anchor $anchor) {
						$anchor->class('active');
					})
				]);
			}

			// -----------------

			if ($current < $page_count) {
				$this->with([
					Anchor::toUrl($url->withParameter('page', $current + 1))->with(icon('arrows.chevron-right'))->class('icon')
				]);
			}
		}
	}

}