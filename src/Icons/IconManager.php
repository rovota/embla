<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Icons;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class IconManager
{
	/**
	 * @var array<string, Collection>
	 */
	protected array $sources;

	public function __construct(array $sources)
	{
		$this->sources = [];

		foreach ($sources as $name => $path) {
			if (file_exists($path)) {
				$data = include $path;
				$data = array_filter($data, function (string|array $value) {
					if (is_string($value)) {
						return strlen($value) > 100;
					}

					return true;
				});

				$this->sources[$name] = Collection::make($data);
			}
		}
	}

	public function get(string $name): Icon|null|string
	{
		if (Str::contains($name, '.') === false) {
			return null;
		}

		[$set, $name] = explode('.', $name, 2);

		if (isset($this->sources[$set]) === false || $this->sources[$set]->has($name) === false) {
			return new Icon("[$set.$name]");
		}

		return new Icon($this->sources[$set]->get($name));
	}
}