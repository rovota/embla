<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs\Elements;

use Rovota\Core\Support\ErrorMessage;
use Rovota\Embla\Components\Component;

class Errors extends Component
{

	public function __construct()
	{
		parent::__construct('input-errors');
	}

	// -----------------
	// Content

	public function setErrors(array $errors): static
	{
		$this->with(Errors::create()->withForEach($errors, function (ErrorMessage $error) {
			return '<span>'.$error->formatted().'</span>';
		}), 'errors');

		return $this;
	}

}