<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Misc;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Facades\Registry;

class Copyright extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'span';

		$this->with(__('&copy; 2009 - :year :site_name', [
			'year' => date('Y'),
			'site_name' => Registry::string('about.author'),
		]));
	}

	// -----------------
	// Starters

	public static function content(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

}