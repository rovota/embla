<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Illuminate\Support\Facades\Facade;
use Rovota\Embla\Tabs\TabsFacadeProxy;

final class Tabs extends Facade
{

	protected static function getFacadeAccessor(): string
	{
		return TabsFacadeProxy::class;
	}

}