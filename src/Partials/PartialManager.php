<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Framework\Facades\View;
use Rovota\Framework\Kernel\ServiceProvider;
use Rovota\Framework\Support\Str;
use Rovota\Framework\Views\Interfaces\ViewInterface;

final class PartialManager extends ServiceProvider
{

	protected PartialConfig $config;

	// -----------------

	public function __construct()
	{
		$this->config = new PartialConfig();
	}

	// -----------------

	public function createPartial(string|null $template, string|null $class = null): PartialInterface
	{
		$config = new PartialConfig([
			'variables' => $this->getDataForType('variables', $template),
		]);

		if ($class !== null) {
			return new $class(null, $config);
		}

		$partial = new DefaultPartial($template, $config);

		if (View::current() instanceof ViewInterface) {
			$partial->with('view', View::current());
		}

		return $partial;
	}

	// -----------------

	public function hasVariable(string $template, string $identifier): bool
	{
		return $this->config->has(sprintf('variables.%s.%s', $template, $identifier));
	}

	public function attachVariable(array|string $templates, string $identifier, mixed $value): void
	{
		if (is_string($templates)) {
			$templates = [$templates];
		}

		foreach ($templates as $template) {
			$key = sprintf('variables.%s.%s', $template, $identifier);
			$this->config->set($key, $value);
		}
	}

	public function updateVariable(array|string $templates, string $identifier, mixed $value): void
	{
		if (is_string($templates)) {
			$templates = [$templates];
		}

		foreach ($templates as $template) {
			$key = sprintf('variables.%s.%s', $template, $identifier);
			if (is_array($value)) {
				foreach ($value as $k => $v) {
					$this->config->set($key . '.' . $k, $v);
				}
			} else {
				$this->config->set($key, $value);
			}
		}
	}

	// -----------------

	protected function getDataForType(string $type, string|null $name): array
	{
		$items = array_map(function ($value) {
			return $value;
		}, $this->config->array($type . '.*'));

		if ($name !== null) {
			$levels = explode('.', $name);

			foreach ($levels as $level) {
				if (Str::endsWith($name, $level) === false) {
					$level = Str::before($name, Str::after($name, $level. '.')) . '*';
				} else {
					$level = $name;
				}

				foreach ($this->config->array($type . '.' . $level) as $key => $value) {
					$items[$key] = $value;
				}
			}
		}

		return $items;
	}

}