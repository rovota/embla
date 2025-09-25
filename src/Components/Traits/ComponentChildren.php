<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Traits;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Rovota\Embla\Components\Component;

trait ComponentChildren
{

	public function with(Component|string|array|null $child, string|null $name = null): static
	{
		if ($child === null) {
			return $this;
		}

		if (is_array($child)) {
			foreach ($child as $name => $component) {
				$this->addChild($component, is_int($name) ? null : $name);
			}
			return $this;
		}

		$this->addChild($child, $name);
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

	public function withTranslated(string $content, array|object $data = []): static
	{
		return $this->withEscaped(Lang::get($content, $data));
	}

	public function withEscaped(string|null $content): static
	{
		return $this->with(e($content ?? ''));
	}

	// -----------------

	protected function addChild(Component|string $child, string|null $name = null): void
	{
		if ($child instanceof Component) {
			$child->withParent($this);
		}

		$this->children->put($name ?? Str::random(14), $child);
	}

	protected function getChild(string $name): Component|string|null
	{
		return $this->children->get($name);
	}

}