<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Integrations\Cloudflare;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Facades\Language;

class Turnstile extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'div';

		$this->class('cf-turnstile');

		$this->attribute('data-language', strtolower(str_replace('_', '-', Language::active()->locale)));
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
		if ($this->attributes->missing('data-sitekey')) {
			$this->attribute('data-sitekey', getenv('TURNSTILE_PUBLIC_KEY'));
		}
	}

}