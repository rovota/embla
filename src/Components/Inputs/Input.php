<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Base\Extensions\InputComponent;
use Rovota\Embla\Components\Inputs\Elements\Extensions\MaskedGroup;
use Rovota\Embla\Components\Inputs\Elements\Group;
use Rovota\Embla\Components\Inputs\Elements\Note;
use Rovota\Embla\Components\Inputs\Elements\Slider;
use Rovota\Embla\Components\Inputs\Fields\Base;
use Rovota\Embla\Components\Inputs\Fields\Range;
use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Inputs\Interfaces\InputMasked;
use Rovota\Embla\Components\Typography\Label;
use Rovota\Framework\Caching\Enums\Driver;
use Rovota\Framework\Facades\Cache;
use Rovota\Framework\Facades\Request;
use Rovota\Framework\Structures\Basket;
use Rovota\Framework\Support\Str;

class Input extends Component
{

	protected Basket $fields;

	// -----------------

	protected function configuration(): void
	{
		$this->fields = new Basket();

		$this->config->tag = 'input-group';

		$this->addChild('', 'label');
		$this->addChild('', 'box');
	}

	// -----------------
	// Starters

	public static function name(string $name): static
	{
		return (new static)->variable('name', $name);
	}

	// -----------------
	// Content

	public function label(string $text, array|object $data = []): static
	{
		$label = Label::text($text, $data);
		if ($this->variables->has('name')) {
			$label->for($this->variables->string('name'));
		}
		return $this->with($label, 'label');
	}

	// -----------------
	// Fields

	public function field(Component $field, string|null $name = null): static
	{
		$field->parent = $this;

		if ($field instanceof InputComponent) {
			if ($field->attributes->missing('name')) {
				$field->attribute('name', $this->variables->get('name'));
			}

			if ($field->attributes->missing('id') && $field instanceof InputCheckable === false) {
				$field->attribute('id', $this->variables->get('name'));
			}
		}

		$this->fields[$name ?? Str::random(14)] = $field;

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
	// Children

	public function withNote(string $text, array|object $data = []): static
	{
		return $this->with(Note::text($text, $data), 'note');
	}

	public function withCharacterCount(): static
	{
		return $this->with(Note::characterCount(), 'note');
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
	// Content

	public function defaultValue(mixed $value): static
	{
		return $this->variable('defaults', is_array($value) ? $value : [$value]);
	}

	public function withoutErrors(): static
	{
		return $this->variable('hide_errors', true);
	}

	// -----------------

	protected function prepareRender(): void
	{
		$group = $this->getFieldGroup();

		foreach ($this->fields as $name => $field) {
			$group->with($field, $name);
		}

		$this->with($group, 'box');
		$this->setValueAutomatically();

		if ($this->variables->missing('hide_errors')) {
//			$this->withErrors();
		}
	}

	// -----------------

	protected function setValueAutomatically(): void
	{
		$data = $this->getValueData();

		foreach ($this->fields as $field) {
			if ($field instanceof Base === false) {
				continue;
			}

			if ($field->attributes->has('name')) {
				$name = $field->attributes->get('name');
				$value = $data[$name] ?? $data['defaults'][$name] ?? $data['defaults'][0] ?? null;

				if ($field instanceof InputCheckable) {
					$field->checkedIf($value === $field->attributes->string('value'));
					continue;
				}

				// TODO: Add support for the select field.

				$field->value($value);
			}
		}
	}

	protected function getValueData(): array
	{
		$cache = convert_to_array(Cache::storeWithDriver(Driver::Session)?->all() ?? []);
		$request = Request::current()->post->toArray();

		return array_merge([
			'defaults' => $this->variables->array('defaults')
		], $request, $cache);
	}

	protected function getFieldGroup(): Component
	{
		foreach ($this->fields as $field) {
			if ($field instanceof Base === false) {
				continue;
			}

			if ($field instanceof Range) {
				return Slider::make();
			}

			if ($field instanceof InputMasked) {
				return MaskedGroup::make();
			}
		}

		return Group::make();
	}

}