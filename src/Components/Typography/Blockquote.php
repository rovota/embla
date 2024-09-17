<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Str;

class Blockquote extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'blockquote';
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->with(Paragraph::content($text, $data));
	}

	// -----------------
	// Content

	public function source(string $text, array|object $data = []): static
	{
		return $this->attribute('cite', Str::translate($text, $data));
	}

}