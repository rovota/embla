<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs;

class Input extends Component
{

	// -----------------

	protected function withErrors(ErrorBucket|string|null $errors = null): static
	{
		if ($errors instanceof ErrorBucket) {
			$errors = $errors->toArray();
		} else {
			$field = $errors ?? $this->variables->get('name', '---');
			$errors = request()->errors()[$field] ?? Session::read('validation_errors')[$field] ?? [];
		}

		if (empty($errors) === false) {
			$this->with(Errors::create()->setErrors($errors), 'errors');
		}

		return $this;
	}

}