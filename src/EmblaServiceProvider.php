<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Rovota\Embla\Icons\IconManager;
use Rovota\Embla\Tabs\TabsFacadeProxy;
use Rovota\Embla\Tabs\TabsManager;
use Rovota\Embla\Toolbar\ToolbarFacadeProxy;
use Rovota\Embla\Toolbar\ToolbarManager;

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

		$this->bindIconFunctionality();
		$this->bindTabsFunctionality();
		$this->bindToolbarFunctionality();
	}

	/**
	 * @return void
	 */
	public function boot(): void
	{
		View::macro('withOverlay', function (string $action, string|null $value = null) {
			\Illuminate\Support\Facades\View::share('trigger_overlay', new Fluent(compact('action', 'value')));
			return $this;
		});

		View::macro('withParent', function (string $action, string|null $value = null) {
			\Illuminate\Support\Facades\View::share('trigger_parent', new Fluent(compact('action', 'value')));
			return $this;
		});

		// -----------------

		$this->publishes([
			__DIR__.'/../config/embla.php' => $this->app->configPath('embla.php'),
		], 'embla-config');

		$this->publishes([
			__DIR__.'/../resources/styles' => $this->app->publicPath('vendor/embla/styles'),
		], 'embla-styles');

		$this->publishes([
			__DIR__.'/../resources/scripts' => $this->app->publicPath('vendor/embla/scripts'),
		], 'embla-scripts');

		// -----------------

		Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'embla');
	}

	// -----------------

	protected function bindIconFunctionality(): void
	{
		$this->app->singleton(IconManager::class, function ($app) {
			return new IconManager(
				$app->make('config')->get('embla.icons')
			);
		});
	}

	protected function bindTabsFunctionality(): void
	{
		$this->app->singleton(TabsManager::class, function ($app) {
			return new TabsManager();
		});

		$this->app->singleton(TabsFacadeProxy::class, function ($app) {
			return new TabsFacadeProxy($app->make(TabsManager::class));
		});
	}

	protected function bindToolbarFunctionality(): void
	{
		$this->app->singleton(ToolbarManager::class, function ($app) {
			return new ToolbarManager();
		});

		$this->app->singleton(ToolbarFacadeProxy::class, function ($app) {
			return new ToolbarFacadeProxy($app->make(ToolbarManager::class));
		});
	}
}