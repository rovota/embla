<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Framework\Support\Url;

class Link extends Anchor
{

	public function toPath(string $path, array $parameters = []): static
	{
		return $this->to(Url::local($path, $parameters));
	}

	public function toCurrent(): static
	{
		return $this->to(Url::current());
	}

	public function toForeign(string $location, array $parameters = []): static
	{
		return $this->to(Url::foreign($location, $parameters));
	}

	public function toFile(string $location, array $parameters = [], string|null $disk = null): static
	{
		return $this->to(Url::file($location, $parameters, $disk));
	}

	public function toRoute(string $name, array $context = [], array $parameters = []): static
	{
		return $this->to(Url::route($name, $context, $parameters));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public function toPrevious(string $default = '/'): static
	{
		return $this->to(Url::previous($default));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public function toNext(string $default = '/'): static
	{
		return $this->to(Url::next($default));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public function toIntended(string $default = '/'): static
	{
		return $this->to(Url::intended($default));
	}

	// -----------------

	public function message(string $message): static
	{
		return (new static)->attributes([
			'href' => request()->url(), 'data-message' => $message
		]);
	}

}