<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Icons;

use Rovota\Framework\Kernel\ServiceProvider;
use Rovota\Framework\Structures\Bucket;

final class IconManager extends ServiceProvider
{

	protected Bucket $icons;

	// -----------------

	public function __construct(array $sources = [])
	{
		$this->icons = new Bucket();

		foreach ($sources as $name => $path) {
			if (file_exists($path)) {
				$data = include $path;
				$this->icons->import($data);
			}
		}
	}

	// -----------------

	public function getIcon(string $name): Icon|null
	{
		if ($this->icons->has($name)) {
			return new Icon($this->icons->get($name));
		}

		return null;
	}

}