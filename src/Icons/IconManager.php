<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Icons;

use Illuminate\Support\Collection;
final class IconManager
{

	/**
	 * @var array<string, Collection>
	 */
	protected Collection $sources;

	public function __construct(array $sources)
	{
		$this->sources = new Collection();
	}

	// -----------------


	public function consddtruct()
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

	public function getIcon(string $name): Icon|null|string
	{
		return 'icon: '.$name;
//		if (Str::contains($name, '.') === false) {
//			return null;
//		}
//
//		[$set, $name] = explode('.', $name, 2);
//
//		if (isset($this->sources[$set]) === false || $this->sources[$set]->missing($name)) {
//			return new Icon("[$set.$name]");
//		}
//
//		return new Icon($this->sources[$set]->get($name));
	}

}