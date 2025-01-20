<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Traits;

use BackedEnum;
use Rovota\Framework\Support\Str;
use Stringable;

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
		if ($value === null) {
			$name = $this->getUsableValue($name);
			if ($this->attributes->find($name) === false) {
				$this->attributes->append($name);
			}
			return $this;
		}

		$this->attributes->set($name, $this->getUsableValue($value));
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
		$this->attributes->remove($name);
		return $this;
	}

	// -----------------

	public function attributeTranslated(string $name, mixed $value): static
	{
		return $this->attributeEscaped($name, $value);
	}

	public function attributeEscaped(string $name, mixed $value): static
	{
		return $this->attribute($name, Str::escape((string) $value));
	}

	// -----------------

	public function class(string|array $name): static
	{
		foreach (convert_to_array($name) as $key => $value) {
			if (is_numeric($key)) {
				$this->classes->append($this->getUsableValue($value));
			}
			if ($value === true) {
				$this->classes->append($this->getUsableValue($key));
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
			$this->classes->set($key, $this->getUsableValue($replacement));
		} else {
			$this->classes->append($this->getUsableValue($replacement));
		}
	}

	// -----------------

	protected function getUsableValue(mixed $value): mixed
	{
		if ($value instanceof BackedEnum) {
			return $value->value;
		}

		if ($value instanceof Stringable) {
			return (string) $value;
		}

		return $value;
	}

}