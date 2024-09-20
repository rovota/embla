<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class ListItem extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'li';
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

}