<?php

namespace Rovota\Embla;

use Illuminate\Support\ServiceProvider;
use Rovota\Embla\Icons\IconManager;

class EmblaServiceProvider extends ServiceProvider
{
	/**
	 * @return void
	 */
	public function register(): void
	{
		$this->mergeConfigFrom(
			__DIR__.'/../config/embla.php', 'embla'
		);

		$this->app->singleton(IconManager::class, function ($app) {
			return new IconManager(
				$app->make('config')->get('embla.icons')
			);
		});
	}

	/**
	 * @return void
	 */
	public function boot(): void
	{
		$this->publishes([
			__DIR__.'/../config/embla.php' => $this->app->configPath('embla.php'),
		], 'embla-config');

		$this->publishes([
			__DIR__.'/../resources' => $this->app->publicPath('vendor/embla'),
		], 'embla-assets');
	}
}