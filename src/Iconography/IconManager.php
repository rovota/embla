<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Iconography;

final class IconManager
{

	protected static array $sets = [];

	protected static string $default = 'default';

	// -----------------

	protected function __construct()
	{
	}

	// -----------------

	public static function getIcon(string $name, string|null $set = null): Icon
	{
		self::initialize();

		if ($set === null || !isset(self::$sets[$set])) {
			$set = self::$default;
		}

		return self::$sets[$set]->get($name);
	}

	public static function getSet(string|null $name): IconSet
	{
		$name ??= self::$default;

		return self::$sets[$name] ?? self::$sets[self::$default];
	}

	// -----------------

	public static function addToSet(string|null $set, string|array $data): void
	{
		$set = $set ?? self::$default;
		self::createSetIfMissing($set);

		if (is_string($data) && file_exists($data)) {
			$data = include $data;
		}
		self::$sets[$set]->import($data);
	}

	// -----------------

	protected static function initialize(): void
	{
		self::createSetIfMissing(self::$default);
	}

	protected static function createSetIfMissing(string $name): void
	{
		if (isset(self::$sets[$name]) === false) {
			self::$sets[$name] = new IconSet();
		}
	}

}

function icon(string $name, string|null $set = null): Icon
{
	return IconManager::getIcon($name, $set);
}