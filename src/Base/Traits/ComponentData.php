<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Traits;

use Rovota\Framework\Facades\Cast;

trait ComponentData
{

	public function variable(array|string $name, mixed $value = null): static
	{
		$variables = is_array($name) ? $name : [$name => $value];

		foreach ($variables as $name => $value) {
			$this->variables->set($name, $value);
		}

		return $this;
	}

	// -----------------

	public function attribute(string $name, mixed $value = null): static
	{
		$name = Cast::toRawAutomatic($name);

		if ($value === null) {
			if ($this->attributes->find($name) === false) {
				$this->attributes->append($name);
			}
			return $this;
		}

		$this->attributes->set($name, Cast::toRawAutomatic($value));
		return $this;
	}

	public function attributes(array $items): static
	{
		foreach ($items as $name => $value) {
			if (is_int($name)) {
				$this->attribute($value);
				continue;
			}
			$this->attribute($name, $value);
		}
		return $this;
	}

	// -----------------

	public function class(string|array $name): static
	{
		foreach (convert_to_array($name) as $key => $value) {
			if (is_numeric($key)) {
				$this->classes->append(Cast::toRawAutomatic($value));
			}
			if ($value === true) {
				$this->classes->append(Cast::toRawAutomatic($key));
			}
		}

		return $this;
	}

	// -----------------

	protected function replaceClassWithPrefix(string $prefix, string $replacement): void
	{
		$key = $this->classes->find(function ($class) use ($prefix) {
			return str_starts_with($class, $prefix);
		});

		if ($key !== false) {
			$this->classes->set($key, Cast::toRawAutomatic($replacement));
		} else {
			$this->classes->append(Cast::toRawAutomatic($replacement));
		}
	}

}