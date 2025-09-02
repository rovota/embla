<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Facades;

use Closure;
use Rovota\Embla\Partials\Partial;
use Rovota\Embla\Partials\PartialManager;
use Rovota\Framework\Support\Facade;

/**
 * @method static Partial create(string $template, string|null $class = null)
 *
 * @method static void attachVariable(string $identifier, mixed $value)
 * @method static void updateVariable(string $identifier, mixed $value)
 */
final class Partials extends Facade
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