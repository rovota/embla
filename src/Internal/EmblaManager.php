<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Internal;

use Rovota\Embla\Icons\IconManager;
use Rovota\Framework\Facades\View;
use Rovota\Framework\Kernel\ServiceProvider;

final class EmblaManager extends ServiceProvider
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

	public function getConfig(): EmblaConfig
	{
		return $this->config;
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
		View::attachScript('*', 'jquery', [
			'source' => self::ASSET_FOLDER . '/scripts/jquery-3.7.1.slim.min.js',
		]);
		View::attachScript('*', 'framework', [
			'source' => self::ASSET_FOLDER . '/scripts/framework.js',
		]);

		// CSS
		View::attachLink('*', 'framework', [
			'style' => self::ASSET_FOLDER . '/styles/framework.css',
		]);
		View::attachLink('*', 'theming', [
			'style' => self::ASSET_FOLDER . '/styles/theming.css',
		]);
	}

}