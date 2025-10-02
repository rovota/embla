<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Illuminate\Support\Facades\Facade;
use Rovota\Embla\Toolbar\ToolbarFacadeProxy;

final class Toolbar extends Facade
{

	protected static function getFacadeAccessor(): string
	{
		return ToolbarFacadeProxy::class;
	}

}