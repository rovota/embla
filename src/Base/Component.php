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
use Rovota\Framework\Structures\Bucket;
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
	 * @var Bucket<string|int, Component>
	 */
	public Bucket $children;

	public Bucket $variables;

	public Bucket $attributes;

	public Bucket $classes;

	// -----------------

	public function __construct(Component|null $parent = null)
	{
		$this->parent = $parent;
		$this->config = new ComponentConfig();

		$this->children = new Bucket();
		$this->variables = new Bucket();
		$this->attributes = new Bucket();
		$this->classes = new Bucket();

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

	/**
	 * @deprecated You should use ``new class()`` instead. This method will be removed in a future revision.
	 */
	public static function make(): static
	{
		return new static;
	}

	// -----------------

	protected function render(): string
	{
		$this->prepareRender();

		$fragments = Bucket::from([
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
			return $fragments->append('></' . $this->config->tag . '>')->join(' ', '');
		}

		$component = Bucket::from([
			$fragments->append('>')->join(' ', ''),
			implode('', $this->children->toArray()),
			'</' . $this->config->tag . '>'
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
		$attributes = new Bucket();

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