<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Services;

use Rovota\Embla\Internal\EmblaConfig;
use Rovota\Framework\Facades\View;
use Rovota\Framework\Kernel\ServiceProvider;

final class EmblaManager extends ServiceProvider
{

	const string ASSET_FOLDER = '/vendor/rovota/embla/src/assets';

	// -----------------

	protected EmblaConfig $config;

	// -----------------

	public function __construct()
	{
		$this->config = EmblaConfig::load('config/embla');

		$this->attachAssets();
	}

	// -----------------

	public function getConfig(): EmblaConfig
	{
		return $this->config;
	}

	// -----------------

	// -----------------

	// -----------------

	protected function attachAssets(): void
	{
		// JavaScript
		View::attachScript('*', 'framework', [
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