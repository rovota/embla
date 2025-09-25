<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Navigation;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Rovota\Embla\Components\Component;

class Anchor extends Component
{

	public string $tag = 'a';

	// -----------------
	// Target

	public function target(string $target): static
	{
		return $this->attribute('href', $target);
	}

	public function to(string $path, array $parameters = []): static
	{
		return $this->target(url()->query($path, $parameters));
	}

	public function toCurrent(): static
	{
		return $this->target(url()->current());
	}

	public function toPrevious(string $default = '/'): static
	{
		return $this->target(url()->previous($default));
	}

	public function toRoute(string $name, $parameters = []): static
	{
		return $this->target(route($name, $parameters));
	}

	public function toIntended(string $default = '/'): static
	{
		return $this->to(Session::get('url.intended', $default));
	}

	public function toFile(string $location, string|null $disk = null): static
	{
		return $this->target(Storage::disk($disk)->url($location));
	}

	// -----------------

	public function message(string $message): static
	{
		return (new static)->attributes([
			'href' => request()->url(), 'data-message' => $message
		]);
	}

	// -----------------
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Behavior

	public function download(string|null $name = null): static
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

}