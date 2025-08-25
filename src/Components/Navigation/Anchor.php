<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Routing\UrlObject;

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
		return (new static)->attribute('href', (string)$url);
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