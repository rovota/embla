<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Paragraph extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'p';
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

}