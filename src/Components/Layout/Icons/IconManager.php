<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Layout\Icons;

use Rovota\Framework\Kernel\ServiceProvider;
use Rovota\Framework\Structures\Bucket;
use Rovota\Framework\Support\Str;

final class IconManager extends ServiceProvider
{

	/**
	 * @var array<string, Bucket>
	 */
	protected array $sources = [];

	// -----------------

	public function __construct(array $sources = [])
	{
		foreach ($sources as $name => $path) {
			if (file_exists($path)) {
				$data = include $path;
				$data = array_filter($data, function (string|array $value) {
					if (is_string($value)) {
						return strlen($value) > 100;
					}

					return true;
				});

				$this->sources[$name] = Bucket::from($data);
			}
		}
	}

	// -----------------

	public function getSource(string $name): Bucket|null
	{
		return $this->sources[$name] ?? null;
	}

	// -----------------

	public function getIcon(string $name): Icon|null
	{
		if (Str::contains($name, '.') === false) {
			return null;
		}

		[$set, $name] = explode('.', $name, 2);

		if (isset($this->sources[$set]) === false || $this->sources[$set]->missing($name)) {
			return new Icon("[$set.$name]");
		}

		return new Icon($this->sources[$set]->get($name));
	}

}