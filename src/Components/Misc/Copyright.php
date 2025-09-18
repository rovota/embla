<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Misc;

use Rovota\Embla\Components\Typography\Span;
use Rovota\Framework\Facades\Registry;

class Copyright extends Span
{

	protected function configuration(): void
	{
		$this->config->tag = 'span';

		$this->addChild(__('&copy; :year - :site_name', [
			'year' => date('Y'),
			'site_name' => Registry::string('about.author'),
		]));
	}

}