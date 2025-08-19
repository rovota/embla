<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Routing\UrlObject;
use Rovota\Framework\Support\Url;

class Anchor extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
	}

	// -----------------
	// Starters

	public static function toUrl(UrlObject $url): static
	{
		return (new static)->attribute('href', (string) $url);
	}

	public static function to(string $path, array $parameters = []): static
	{
		return self::toUrl(Url::local($path, $parameters));
	}

	public static function toCurrent(): static
	{
		return self::toUrl(Url::current());
	}

	public static function toFile(string $location, array $parameters = [], string|null $disk = null): static
	{
		return self::toUrl(Url::file($location, $parameters, $disk));
	}

	public static function toRoute(string $name, array $context = [], array $parameters = []): static
	{
		return self::toUrl(Url::route($name, $context, $parameters));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public static function toPrevious(string $default = '/'): static
	{
		return self::toUrl(Url::previous($default));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public static function toNext(string $default = '/'): static
	{
		return self::toUrl(Url::next($default));
	}

	/**
	 * This method requires the presence of a cache store using the `session` driver.
	 */
	public static function toIntended(string $default = '/'): static
	{
		return self::toUrl(Url::intended($default));
	}

	// -----------------

	public static function sendMessage(string $message): static
	{
		return (new static)->attributes([
			'href' => request()->url(), 'data-message' => $message
		]);
	}

	// -----------------
	// Content

	public function label(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Interactivity

	public function asDownload(string|null $name = null): static
	{
		return $this->attribute('download', $name);
	}

	public function inNewTab(): static
	{
		return $this->attribute('target', '_blank');
	}

	public function inParent(): static
	{
		return $this->attribute('target', '_parent');
	}

	public function inOverlay(): static
	{
		return $this->attribute('data-overlay');
	}

	public function withoutReferrer(): static
	{
		return $this->attribute('rel', 'noreferrer');
	}

	public function disabled(): static
	{
		return $this->attribute('disabled');
	}

}