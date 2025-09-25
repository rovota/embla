<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;
use Rovota\Embla\Components\Traits\AccessibilityMethods;
use Rovota\Embla\Components\Traits\AppearanceMethods;
use Rovota\Embla\Components\Traits\ComponentChildren;
use Rovota\Embla\Components\Traits\ComponentData;
use Rovota\Embla\Components\Traits\ComponentMeta;
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

	public string $tag = 'div';

	public bool $self_closing = false;

	// -----------------

	/**
	 * @var Collection<string|int, Component>
	 */
	public Collection $children;

	public Collection $variables;

	public Collection $attributes;

	public Collection $classes;

	// -----------------

	public function __construct(Component|null $parent = null)
	{
		$this->parent = $parent;

		$this->children = new Collection();
		$this->variables = new Collection();
		$this->attributes = new Collection();
		$this->classes = new Collection();

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

		$fragments = Collection::make([
			sprintf('<%s', $this->tag),
			$this->getFormattedAttributes(),
			$this->getFormattedClasses(),
		])->filter(function (string $fragment) {
			return strlen($fragment) > 0;
		});

		if ($this->self_closing) {
			return $fragments->add('/>')->join(' ');
		}

		if ($this->children->isEmpty()) {
			return $fragments->add('></' . $this->tag . '>')->join(' ');
		}

		$component = Collection::make([
			$fragments->add('>')->join(' '),
			implode('', $this->children->toArray()),
			'</' . $this->tag . '>'
		]);

		return $component->join('');
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
		$attributes = new Collection();

		foreach ($this->attributes as $name => $value) {
			if (is_int($name)) {
				$attributes->add(e($value));
				continue;
			}

			$attributes->add(sprintf('%s="%s"', $name, e($value)));
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