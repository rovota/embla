<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base;

use Rovota\Embla\Base\Traits\AccessibilityMethods;
use Rovota\Embla\Base\Traits\AppearanceMethods;
use Rovota\Embla\Base\Traits\ComponentChildren;
use Rovota\Embla\Base\Traits\ComponentData;
use Rovota\Embla\Base\Traits\ComponentMeta;
use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Str;
use Rovota\Framework\Support\Traits\Conditionable;
use Stringable;

abstract class Component implements Stringable
{
	use Conditionable;
	use ComponentChildren;
	use ComponentData;
	use ComponentMeta;

	use AppearanceMethods;
	use AccessibilityMethods;

	// -----------------

	public Component|null $parent {
		get => $this->parent;
		set {
			$this->parent = $value;
		}
	}

	public ComponentConfig $config {
		get => $this->config;
	}

	// -----------------

	/**
	 * @var Basket<string|int, Component>
	 */
	public Basket $children;

	public Basket $variables;

	public Basket $attributes;

	public Basket $classes;

	// -----------------

	public function __construct(Component|null $parent = null)
	{
		$this->parent = $parent;
		$this->config = new ComponentConfig();

		$this->children = new Basket();
		$this->variables = new Basket();
		$this->attributes = new Basket();
		$this->classes = new Basket();

		$this->configuration();
	}

	public function __toString(): string
	{
		return $this->render();
	}

	// -----------------

	public function withParent(Component|null $parent): static
	{
		$this->parent = $parent;
		return $this;
	}

	// -----------------

	public static function make(): static
	{
		return new static;
	}

	// -----------------

	protected function render(): string
	{
		$this->prepareRender();

		$fragments = Basket::from([
			sprintf('<%s', $this->config->tag),
			$this->getFormattedAttributes(),
			$this->getFormattedClasses(),
		])->filter(function (string $fragment) {
			return strlen($fragment) > 0;
		});

		if ($this->config->self_closing) {
			return $fragments->append('/>')->join(' ', '');
		}

		if ($this->children->isEmpty()) {
			return $fragments->append('></'.$this->config->tag.'>')->join(' ', '');
		}

		$component = Basket::from([
			$fragments->append('>')->join(' ', ''),
			implode('', $this->children->toArray()),
			'</'.$this->config->tag.'>'
		]);

		return $component->join();
	}

	// -----------------

	protected function prepareRender(): void
	{

	}

	protected function configuration(): void
	{

	}

	// -----------------

	private function getFormattedAttributes(): string
	{
		$attributes = new Basket();

		foreach ($this->attributes as $name => $value) {
			if (is_int($name)) {
				$attributes->append(Str::escape($value));
				continue;
			}

			$attributes->append(sprintf('%s="%s"', $name, Str::escape($value)));
		}

		return trim($attributes->join(' '));
	}

	private function getFormattedClasses(): string
	{
		if ($this->classes->isEmpty()) {
			return '';
		}

		return sprintf('class="%s"', $this->classes->join(' '));
	}

}