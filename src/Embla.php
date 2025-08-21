<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla;

use Rovota\Embla\Components\Layout\Icons\IconManager;
use Rovota\Framework\Facades\View;
use Rovota\Framework\Kernel\ServiceProvider;

final class Embla extends ServiceProvider
{

	const string ASSET_FOLDER = '/vendor/rovota/embla/src/assets';

	// -----------------

	protected EmblaConfig $config;

	protected IconManager $icons;

	// -----------------

	public function __construct()
	{
		$this->config = EmblaConfig::load('config/embla');

		$this->icons = new IconManager($this->config->array('icons'));

		$this->attachAssets();
	}

	// -----------------

	public function getIconManager(): IconManager
	{
		return $this->icons;
	}

	// -----------------

	protected function attachAssets(): void
	{
		// JavaScript
		View::attachScript('*', 'signature', [
			'source' => self::ASSET_FOLDER . '/scripts/signature.min.js',
		]);
		View::attachScript('*', 'embla', [
			'source' => self::ASSET_FOLDER . '/scripts/embla.js',
		]);
		View::attachScript('*', 'spotlight', [
			'source' => self::ASSET_FOLDER . '/scripts/spotlight.min.js',
		]);

		// CSS
		View::attachLink('*', 'embla', [
			'style' => self::ASSET_FOLDER . '/styles/embla.css',
		]);
		View::attachLink('*', 'spotlight', [
			'style' => self::ASSET_FOLDER . '/styles/spotlight.min.css',
		]);
		View::attachLink('*', 'theming', [
			'style' => self::ASSET_FOLDER . '/styles/theming.css',
		]);
	}

}