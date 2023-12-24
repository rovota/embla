<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

use Rovota\Core\Support\Str;
use Rovota\Embla\Components\Component;

class Info extends Component
{

	public function __construct()
	{
		parent::__construct('info');
	}

	// -----------------
	// Content

	public static function content(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->with(Paragraph::content($text, $args));
		return $component;
	}

	public function caption(string $text, array|object $args = []): static
	{
		$this->attribute('caption', Str::translate($text, $args));
		return $this;
	}

}