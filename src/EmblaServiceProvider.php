<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Rovota\Embla\Icons\IconManager;
use Rovota\Embla\Tabs\TabsFacadeProxy;
use Rovota\Embla\Tabs\TabsManager;

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

		$this->app->singleton(TabsManager::class, function ($app) {
			return new TabsManager();
		});

		$this->app->singleton(TabsFacadeProxy::class, function ($app) {
			return new TabsFacadeProxy($app->make(TabsManager::class));
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

		Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'embla');
	}
}