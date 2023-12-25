<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Components\Forms\Inputs;

use Rovota\Core\Facades\Session;
use Rovota\Core\Structures\Bucket;
use Rovota\Core\Structures\ErrorBucket;
use Rovota\Core\Support\Str;
use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Forms\Inputs\Elements\Errors;
use Rovota\Embla\Components\Forms\Inputs\Elements\Group;
use Rovota\Embla\Components\Forms\Inputs\Elements\GroupMasked;
use Rovota\Embla\Components\Forms\Inputs\Elements\Note;
use Rovota\Embla\Components\Forms\Inputs\Elements\Slider;
use Rovota\Embla\Components\Forms\Inputs\Fields\Base;
use Rovota\Embla\Components\Forms\Inputs\Fields\Range;
use Rovota\Embla\Components\Typography\Label;

class Input extends Component
{

	protected Bucket $fields;

	// -----------------

	public function __construct()
	{
		parent::__construct('input-group');

		$this->fields = new Bucket();

		// Define order
		$this->with('', 'label');
		$this->with('', 'fields');
	}

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

	public function label(string $text, array|object $args = []): static
	{
		$label = Label::text($text, $args);
		if ($this->variables->has('name')) {
			$label->for($this->variables->string('name'));
		}

		return $this->with($label, 'label');
	}

	public function defaultValue(mixed $value): static
	{
		$this->variable('defaults', is_array($value) ? $value : [$value]);
		return $this;
	}

	// -----------------
	// Fields

	public function field(Component $field, string|null $name = null): static
	{
		$field->config->parent = $this;
		$this->fields[$name ?? Str::random(15)] = $field;

		if ($field->attributes->missing('name')) {
			$field->attribute('name', $this->variables->get('name'));
		}

		if ($field->attributes->missing('id') && $field instanceof InputCheckable === false) {
			$field->attribute('id', $this->variables->get('name'));
		}

		return $this;
	}

	public function fields(array $fields): static
	{
		foreach ($fields as $name => $field) {
			$this->field($field, is_int($name) ? null : $name);
		}
		return $this;
	}

	public function fieldForEach(mixed $dataset, callable $callback): static
	{
		foreach ($dataset as $key => $value) {
			$this->field($callback($value, $key), $key);
		}
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

	public function withErrors(ErrorBucket|string|null $errors = null): static
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

	public function withoutErrors(): static
	{
		$this->variable('hide_errors', true);
		return $this;
	}

	// -----------------

	protected function build(): void
	{
		$group = $this->getFieldGroup();
		foreach ($this->fields as $name => $field) {
			$group->with($field, $name);
		}

		$this->with($group, 'fields');
		$this->setValueAutomatically();
		if ($this->variables->missing('hide_errors')) {
			$this->withErrors();
		}
	}

	// -----------------

	protected function getFieldGroup(): Component
	{
		foreach ($this->fields as $field) {
			if ($field instanceof Base === false) {
				continue;
			}

			if ($field instanceof Range) {
				return Slider::create();
			}

			if ($field instanceof InputMasked) {
				return GroupMasked::create();
			}
		}

		return Group::create();
	}

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

}