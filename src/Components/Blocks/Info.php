<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Illuminate\Support\Facades\Lang;
use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Typography\Paragraph;

class Info extends Component
{

	public string $tag = 'info';

	// -----------------
	// Content

	public function paragraph(string $text, array|object $data = []): static
	{
		return $this->with(new Paragraph()->text($text, $data), 'text');
	}

	public function caption(string $text, array|object $data = []): static
	{
		return $this->attribute('caption', Lang::get($text, $data));
	}

}