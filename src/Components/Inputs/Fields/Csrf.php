<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Auth\CsrfManager;

class Csrf extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Hidden);
		}

		$this->attribute('name', CsrfManager::getTokenName());
		$this->attribute('value', CsrfManager::getToken());
	}

}