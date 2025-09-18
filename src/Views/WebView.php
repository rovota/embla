<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views;

use Rovota\Embla\Views\Traits\WebFunctions;
use Rovota\Framework\Views\View;

class WebView extends View
{
	use WebFunctions;

	// -----------------

	protected function prepareData(): void
	{
		parent::prepareData();

		$this->withMeta('format-detection', [
			'name' => 'format-detection',
			'content' => 'telephone=no',
		]);

		$this->withMeta('viewport', [
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1',
		]);

		$this->withMeta('color-scheme', [
			'name' => 'color-scheme',
			'content' => 'light dark',
		]);

		$this->withMeta('theme-color-light', [
			'name' => 'theme-color',
			'content' => '#F2F2F2', 'media' => '(prefers-color-scheme: light)',
		]);

		$this->withMeta('theme-color-dark', [
			'name' => 'theme-color',
			'content' => '#0F0F0F', 'media' => '(prefers-color-scheme: dark)',
		]);
	}

}