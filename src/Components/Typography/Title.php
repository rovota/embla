<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Title extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'h1';
	}

	// -----------------
	// Starters

	public static function text(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

}