<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials\Traits;

trait PartialFunctions
{

	public function with(array|string $name, mixed $value = null): static
	{
		if (is_array($name)) {
			foreach ($name as $key => $value) {
				$this->with($key, $value);
			}

			return $this;
		}

		$this->config->set('variables.' . $name, $value);

		return $this;
	}

	public function getVariables(): array
	{
		return $this->config->variables;
	}

}