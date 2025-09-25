<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators;

use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Navigation\Anchor;

class Pagination extends Component
{

	public string $tag = 'pagination';

	// -----------------
	// Content

	public function pages(int $number): static
	{
		return $this->variable('page_count', $number);
	}

	// -----------------

	protected function prepareRender(): void
	{
		$page_count = $this->variables->get('page_count', 0);

		if ($page_count > 0) {

			$current = request()->query('page', 1);

			// -----------------

			if ($current > 1) {
				$this->with([
					new Anchor()->to(request()->fullUrlWithQuery(['page' => $current - 1]))->with(icon('arrows.chevron-left'))->class('icon')
				]);
			}

			// -----------------

			$pages = array_fill(1, $page_count, 0);

			foreach ($pages as $number => $value) {
				$this->with([
					new Anchor()->to(request()->fullUrlWithQuery(['page' => $number]))->with($number)->when($current === $number, function (Anchor $anchor) {
						$anchor->class('active');
					})
				]);
			}

			// -----------------

			if ($current < $page_count) {
				$this->with([
					new Anchor()->to(request()->fullUrlWithQuery(['page' => $current + 1]))->with(icon('arrows.chevron-right'))->class('icon')
				]);
			}
		}
	}

}