<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Support\Message;
use Rovota\Framework\Support\MessageBag;
use Rovota\Framework\Validation\Validator;

class Errors extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'input-errors';
	}

	// -----------------
	// Starters

	public function using(Validator|MessageBag|array $errors): static
	{
		if ($errors instanceof Validator) {
			$errors = $errors->errors;
		}

		return $this->withForEach($errors, function (Message $error) {
			return '<span>' . $error->formatted() . '</span>';
		});
	}

}