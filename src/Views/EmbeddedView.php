<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views;

use Rovota\Framework\Views\DefaultView;
use Rovota\Framework\Views\ViewConfig;

class EmbeddedView extends DefaultView
{

	public function __construct(string|null $template, ViewConfig $config)
	{
		parent::__construct($template, $config);

		$this->withMeta('format-detection', [
			'name' => 'format-detection',
			'content' => 'telephone=no',
		]);

		$this->withMeta('viewport', [
			'name' => 'viewport',
			'content' => 'width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=1',
		]);
	}

}