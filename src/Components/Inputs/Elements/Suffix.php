<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;

class Suffix extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-suffix';
	}

	// -----------------
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

}