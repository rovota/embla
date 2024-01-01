<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Navigation;

use Rovota\Core\Facades\Url;
use Rovota\Core\Routing\UrlBuilder;
use Rovota\Core\Routing\UrlObject;
use Rovota\Embla\Component;

class Anchor extends Component
{

	public function __construct()
	{
		parent::__construct('a');
	}

	// -----------------
	// Content

	public function label(string $text, array|object $args = []): static
	{
		$this->withText($text, $args);
		return $this;
	}

	// -----------------
	// Behavior

	public function asDownload(string $name = null): static
	{
		$this->attribute('download', $name);
		return $this;
	}

	public function inNewTab(): static
	{
		$this->attribute('target', '_blank');
		return $this;
	}

	public function withoutReferrer(): static
	{
		$this->attribute('rel', 'noreferrer');
		return $this;
	}

	// -----------------
	// Interactivity

	public static function to(string $path): static
	{
		$anchor = new static;
		$anchor->attribute('href', url()->local($path));
		return $anchor;
	}

	public static function toUrl(UrlBuilder|UrlObject $url): static
	{
		$anchor = new static;
		$anchor->attribute('href', $url);
		return $anchor;
	}

	public static function toAsset(string $path, array $query = [], string|null $disk = null): static
	{
		$anchor = new static;
		$anchor->attribute('href', asset_url($path, $query, $disk));
		return $anchor;
	}

	public static function toRoute(string $name, array $params = [], array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toRoute($name, $params, $query));
		return $anchor;
	}

	public static function toSubdomain(string|null $name, string $path = '/', array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toSubdomain($name, $path, $query));
		return $anchor;
	}

	public static function toPrevious(string $default = '/', array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toPrevious($default, $query));
		return $anchor;
	}

	public static function toNext(string $default = '/', array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toNext($default, $query));
		return $anchor;
	}

	public static function toIntended(string $default = '/', array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toIntended($default, $query));
		return $anchor;
	}

	public static function toForeign(string $location, array $query = []): static
	{
		$anchor = new static;
		$anchor->attribute('href', Url::toForeign($location, $query));
		return $anchor;
	}

}