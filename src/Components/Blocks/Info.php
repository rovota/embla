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
	// Content

	public function paragraph(string $text, array|object $data = []): static
	{
		return $this->with(new Paragraph()->text($text, $data), 'text');
	}

	public function caption(string $text, array|object $data = []): static
	{
		return $this->attribute('caption', Str::translate($text, $data));
	}

}