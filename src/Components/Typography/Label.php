<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Label extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'label';
	}

	// -----------------
	// Starters

	public static function text(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

	// -----------------
	// Data

	public function for(string $id): static
	{
		return $this->attribute('for', $id);
	}

}