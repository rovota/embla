<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Integrations\Cloudflare;

use Illuminate\Support\Facades\Lang;
use Rovota\Embla\Components\Component;

class Turnstile extends Component
{

	protected function configuration(): void
	{
		$this->tag = 'div';

		$this->class('cf-turnstile');

		$this->attribute('data-language', strtolower(str_replace('_', '-', Lang::locale())));
		$this->attribute('data-size', 'flexible');
		$this->attribute('data-appearance', 'interaction-only');
	}

	// -----------------
	// Data

	public function key(string $key): static
	{
		return $this->attribute('data-sitekey', trim($key));
	}

	// -----------------
	// Behavior

	public function appearance(string $mode): static
	{
		return $this->attribute('data-appearance', trim($mode));
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->attributes->has('data-sitekey') === false) {
			$this->attribute('data-sitekey', getenv('TURNSTILE_PUBLIC_KEY'));
		}
	}

}