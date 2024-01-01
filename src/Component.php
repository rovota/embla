<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla;

use Rovota\Core\Structures\Bucket;
use Rovota\Core\Support\Str;
use Rovota\Core\Support\Traits\Conditionable;

class Component
{
	use ComponentAppearance;
	use ComponentContent;
	use ComponentData;
	use Conditionable;

	// -----------------

	public ComponentConfig $config;

	// -----------------

	public function __construct(string $tag = 'div')
	{
		$this->config = new ComponentConfig([
			'tag' => trim($tag),
		]);

		$this->classes = new Bucket();
		$this->children = new Bucket();
		$this->variables = new Bucket();
		$this->attributes = new Bucket();
	}

	// -----------------

	public function __toString(): string
	{
		return $this->render();
	}

	// -----------------

	public static function create(): static
	{
		return new static;
	}

	// -----------------

	protected function build(): void
	{

	}

	protected function render(): string
	{
		$this->build();

		$html = '<'.$this->config->tag;
		$attributes = $this->getFormattedAttributes();
		$classes = $this->getFormattedClasses();

		if (empty($attributes) === false) {
			$html .= ' '.implode(' ', $attributes);
		}

		if (empty($classes) === false) {
			$html .= ' class="'.implode(' ', $classes).'"';
		}

		if ($this->children->isEmpty()) {
			return $html.($this->config->self_closing ? ' />' : '></'.$this->config->tag.'>');
		}

		return $html.'>'.implode('', $this->children->toArray()).'</'.$this->config->tag.'>';
	}

	protected function getFormattedAttributes(): array
	{
		$attributes = [];

		foreach ($this->attributes as $name => $value) {

			if (is_int($name) && strlen($value) > 0) {
				$attributes[] = Str::escape($value);
				continue;
			}

			$html = $name;
			if (strlen($value) > 0) {
				$html .= '="'.Str::escape($value).'"';
			}

			$attributes[] = $html;
		}

		return $attributes;
	}

	protected function getFormattedClasses(): array
	{
		$classes = [];

		foreach ($this->classes as $class) {
			if (strlen($class) > 0) {
				$classes[] = $class;
			}
		}

		return $classes;
	}

}