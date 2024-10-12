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
	// Content

	public function withNote(Component|string $note, array|object $args = []): static
	{
		$this->with(Note::text($note, $args), 'note');
		return $this;
	}

	public function withCharacterCount(): static
	{
		$this->with(Note::characterCount(), 'note');
		return $this;
	}

	public function withSlugPreview(string $prefix = '/'): static
	{
		$this->with(Note::slugPreview($prefix), 'note');

		if ($this->fields->count() === 1) {
			$this->fields->first()->slugify();
		}

		return $this;
	}

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