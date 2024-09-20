<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Citation extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'cite';
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

}