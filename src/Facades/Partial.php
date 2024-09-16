<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Closure;
use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Embla\Partials\PartialManager;
use Rovota\Framework\Support\Facade;

/**
 * @method static PartialInterface create(string $template, string|null $class = null)
 *
 * @method static bool hasVariable(string $template, string $identifier)
 * @method static void attachVariable(array|string $templates, string $identifier, mixed $value)
 * @method static void updateVariable(array|string $templates, string $identifier, mixed $value)
 */
final class Partial extends Facade
{

	public static function service(): PartialManager
	{
		return parent::service();
	}

	// -----------------

	protected static function getFacadeTarget(): string
	{
		return PartialManager::class;
	}

	protected static function getMethodTarget(string $method): Closure|string
	{
		return match ($method) {
			'create' => 'createPartial',
			default => $method,
		};
	}

}