<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Framework\Facades\Views;
use Rovota\Framework\Kernel\ServiceProvider;
use Rovota\Framework\Structures\Bucket;
use Rovota\Framework\Views\View;

final class PartialManager extends ServiceProvider
{
	protected Bucket $variables;

	// -----------------

	public function __construct()
	{
		$this->variables = new Bucket();
	}

	// -----------------

	public function createPartial(string|null $template, string|null $class = null): Partial
	{
		$partial = $class !== null ? new $class() : new Partial($template);

		if (Views::current() instanceof View) {
			$partial->with('view', Views::current());
		}

		return $partial;
	}

	// -----------------

	public function retrieveData(): array
	{
		return [
			'variables' => $this->variables->toArray(),
		];
	}

	// -----------------

	public function attachVariable(string $identifier, mixed $value): void
	{
		$this->variables->set($identifier, $value);
	}

	public function updateVariable(string $identifier, mixed $value): void
	{
		if (is_array($value)) {
			foreach ($value as $k => $v) {
				$this->variables->set($identifier . '.' . $k, $v);
			}
		} else {
			$this->variables->set($identifier, $value);
		}
	}

}