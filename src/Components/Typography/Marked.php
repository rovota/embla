<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Embla\Base\Component;

class Marked extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'mark';
	}

	// -----------------
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

}