<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Typography;

class Title extends Heading
{

	protected function configuration(): void
	{
		$this->config->tag = 'h1';
	}

}