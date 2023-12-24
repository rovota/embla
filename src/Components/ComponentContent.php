<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components;

use Rovota\Core\Structures\Bucket;
use Rovota\Core\Support\Str;

trait ComponentContent
{

	public Bucket $children;

	// -----------------

	public function with(Component|string|array|null $child, string|null $name = null): static
	{
		if ($child === null) {
			return $this;
		}

		if (is_array($child)) {
			foreach ($child as $name => $component) {
				$this->with($component, is_int($name) ? null : $name);
			}
			return $this;
		}

		if ($child instanceof Component) {
			$child->config->parent = $this;
		}

		$this->children->set($name ?? Str::random(15), $child);

		return $this;
	}

	public function withForEach(mixed $dataset, callable $callback): static
	{
		foreach ($dataset as $key => $value) {
			$this->with($callback($value, $key), $key);
		}
		return $this;
	}

	// -----------------

	public function withText(string $content, array|object $args = []): static
	{
		$this->with(Str::translate($content, $args));
		return $this;
	}

	// -----------------

	protected function getChild(string $name): Component|string|null
	{
		return $this->children->get($name);
	}

}