<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views\Traits;

use Rovota\Embla\Facades\Partial;
use Rovota\Framework\Support\Str;

trait OverlayFunctions
{

	public function withTab(string $value): static
	{
		$this->with('page.tab', trim($value));

		Partial::updateVariable('*', 'page', [
			'tab' => $value,
		]);

		return $this;
	}

	public function withParent(string $value): static
	{
		Partial::attachVariable('*', 'parent', $value);
		return $this;
	}

	// -----------------

	public function withTitle(string $title, array|object $data = []): static
	{
		$title = Str::translate(trim($title), $data);

		$this->with('page.title', $title);
		$this->withMeta('og:title', ['name' => 'og:title', 'content' => $title]);

		Partial::updateVariable('*', 'page', [
			'title' => $title,
		]);

		return $this;
	}

}