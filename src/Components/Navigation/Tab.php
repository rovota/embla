<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Indicators\Badge;
use Rovota\Framework\Support\Url;

class Tab extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'a';
	}

	// -----------------
	// Starters

	public static function for(string $name): static
	{
		return (new static)->attributes([
			'class' => 'tab-'.$name,
		]);
	}

	// -----------------
	// Content

	public function label(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	public function badge(string $text, array|object $data = [], mixed $accent = null): static
	{
		$badge = Badge::label($text, $data)->when($accent !== null, function ($badge) use ($accent) {
			$badge->accent($accent);
		});

		return $this->with($badge);
	}

	// -----------------
	// Targets

	public function target(mixed $target): static
	{
		return $this->attribute('href', (string) $target);
	}

	public function route(string $name, array $context = [], array $parameters = []): static
	{
		return $this->target(Url::route($name, $context, $parameters));
	}

	// -----------------
	// Interactivity

	public function inNewTab(): static
	{
		return $this->attribute('target', '_blank');
	}

	public function withoutReferrer(): static
	{
		return $this->attribute('rel', 'noreferrer');
	}

}