<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Iconography;

use Rovota\Core\Structures\Bucket;

final class IconSet
{

	protected Bucket $icons;

	protected string $fallback;

	// -----------------

	public function __construct(array $icons = [])
	{
		$this->icons = new Bucket($icons);
		$this->fallback = 'fallback';
	}

	// -----------------

	public function import(string|array $data): void
	{
		$this->icons->import($data);
	}

	// -----------------

	public function has(string $name): bool
	{
		return $this->icons->has($name);
	}

	public function get(string $name): Icon
	{
		$result = $this->icons->get($name);

		$icon = match (true) {
			is_array($result) => $result[array_key_first($result)],
			default => $result,
		};

		return new Icon($icon?? $this->icons->get($this->fallback, '-'));
	}

	// -----------------

	public function setFallback(string $content): void
	{
		$this->fallback = $content;
	}

}