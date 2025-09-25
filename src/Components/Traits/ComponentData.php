<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Traits;

use BackedEnum;
use Stringable;

trait ComponentData
{

	public function variable(array|string $name, mixed $value = null): static
	{
		$variables = is_array($name) ? $name : [$name => $value];

		foreach ($variables as $name => $value) {
			$this->variables->put($name, $value);
		}

		return $this;
	}

	// -----------------

	public function attribute(string $name, mixed $value = null): static
	{
		if ($value === null) {
			$name = $this->getUsableValue($name);
			if ($this->attributes->contains($name) === false) {
				$this->attributes->add($name);
			}
			return $this;
		}

		$this->attributes->put($name, $this->getUsableValue($value));
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

	public function withoutAttribute(string $name): static
	{
		$this->attributes->forget($name);
		return $this;
	}

	// -----------------

	public function class(string|array $name): static
	{
		foreach (convert_to_array($name) as $key => $value) {
			if (is_numeric($key)) {
				$this->classes->add($this->getUsableValue($value));
			}
			if ($value === true) {
				$this->classes->add($this->getUsableValue($key));
			}
		}

		return $this;
	}

	public function id(string|int $id): static
	{
		return $this->attribute('id', $id);
	}

	// -----------------

	protected function replaceClassWithPrefix(string $prefix, string $replacement): void
	{
		$key = $this->classes->first(function ($class) use ($prefix) {
			return str_starts_with($class, $prefix);
		});

		if ($key !== false) {
			$this->classes->put($key, $this->getUsableValue($replacement));
		} else {
			$this->classes->add($this->getUsableValue($replacement));
		}
	}

	// -----------------

	protected function getUsableValue(mixed $value): mixed
	{
		if ($value instanceof BackedEnum) {
			return $value->value;
		}

		if ($value instanceof Stringable) {
			return (string)$value;
		}

		return $value;
	}

}