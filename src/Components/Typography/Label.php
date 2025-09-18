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
	// Content

	public function text(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	// -----------------
	// Data

	public function for(string $id): static
	{
		return $this->attribute('for', $id);
	}

}