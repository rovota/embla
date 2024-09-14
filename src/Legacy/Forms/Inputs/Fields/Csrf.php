<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Fields;

use Rovota\Core\Auth\AccessManager;
use Rovota\Embla\Legacy\Forms\Inputs\Enums\InputType;

class Csrf extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::Hidden);
		}

		$this->attribute('name', AccessManager::getCsrfTokenName());
		$this->attribute('value', AccessManager::getCsrfToken());
	}

}