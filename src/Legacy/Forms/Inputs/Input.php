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
	// Identification

	public static function name(string $name): static
	{
		$component = new static;
		$component->variable('name', $name);
		return $component;
	}

	// -----------------
	// Content

	public function defaultValue(mixed $value): static
	{
		$this->variable('defaults', is_array($value) ? $value : [$value]);
		return $this;
	}

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

	public function withoutErrors(): static
	{
		$this->variable('hide_errors', true);
		return $this;
	}

	// -----------------

	// -----------------

	protected function setValueAutomatically(): void
	{
		$defaults = $this->variables->array('defaults');
		$data = array_merge(['defaults' => $defaults], request()->post->toArray(), Session::all());

		foreach ($this->fields as $field) {
			if ($field instanceof Base === false) {
				continue;
			}

			if ($field->attributes->has('name')) {
				$name = $field->attributes->get('name');
				$value = $data[$name] ?? $data['defaults'][$name] ?? $data['defaults'][0] ?? null;

				// TODO: Add support for setting multiple checkboxes values as active.
				// TODO: Add support for the select field.

				if ($field instanceof InputCheckable) {
					$field->checkedIf((string) $value === $field->attributes->string('value'));
				} else {
					$field->value($value);
				}
			}
		}
	}

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