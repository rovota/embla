<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Closure;
use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Embla\Partials\PartialManager;
use Rovota\Embla\Tabs\TabsManager;
use Rovota\Framework\Support\Facade;

/**
 * @method static void title(string $label, mixed $target = null): void
 * @method static void register(array $tabs): void
 * @method static void actions(array $actions): void
 */
final class Tabs extends Facade
{

	public static function service(): TabsManager
	{
		return parent::service();
	}

	// -----------------

	protected static function getFacadeTarget(): string
	{
		return TabsManager::class;
	}

	protected static function getMethodTarget(string $method): Closure|string
	{
		return match ($method) {
			'title' => 'setTitle',
			'register' => 'addTabs',
			'actions' => 'addActions',
			default => $method,
		};
	}

}