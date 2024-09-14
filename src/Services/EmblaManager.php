<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Services;

use Rovota\Framework\Facades\View;
use Rovota\Framework\Kernel\ServiceProvider;

final class EmblaManager extends ServiceProvider
{

	// -----------------

	public function __construct()
	{
		$this->attachAssets();
	}

	// -----------------

	// -----------------

	// -----------------

	// -----------------

	protected function attachAssets(): void
	{
		// JavaScript
		View::attachScript('*', 'framework', [
			'source' => '/vendor/rovota/embla/src/assets/scripts/jquery-3.7.1.slim.min.js',
		]);
		View::attachScript('*', 'framework', [
			'source' => '/vendor/rovota/embla/src/assets/scripts/framework.js',
		]);

		// CSS
		View::attachLink('*', 'framework', [
			'style' => '/vendor/rovota/embla/src/assets/styles/framework.css',
		]);
		View::attachLink('*', 'theming', [
			'style' => '/vendor/rovota/embla/src/assets/styles/theming.css',
		]);
	}

}