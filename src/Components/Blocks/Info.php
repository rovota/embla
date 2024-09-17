<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Typography\Paragraph;
use Rovota\Framework\Support\Str;

class Info extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'info';
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->with(Paragraph::content($text, $data));
	}

	// -----------------
	// Content

	public function caption(string $text, array|object $data = []): static
	{
		return $this->attribute('caption', Str::translate($text, $data));
	}

}