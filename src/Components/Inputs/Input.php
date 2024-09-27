<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Inputs\Elements\Group;
use Rovota\Embla\Components\Inputs\Fields\Base;
use Rovota\Embla\Components\Inputs\Interfaces\InputCheckable;
use Rovota\Embla\Components\Typography\Label;
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

		$this->with('', 'label');
		$this->with('', 'box');
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

		if ($field->attributes->missing('name')) {
			$field->attribute('name', $this->variables->get('name'));
		}

		if ($field->attributes->missing('id') && $field instanceof InputCheckable === false) {
			$field->attribute('id', $this->variables->get('name'));
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
	// Content

	// -----------------

	protected function prepareRender(): void
	{
		$group = $this->getFieldGroup();

		foreach ($this->fields as $name => $field) {
			$group->with($field, $name);
		}

		$this->with($group, 'box');
//		$this->setValueAutomatically();
//		if ($this->variables->missing('hide_errors')) {
//			$this->withErrors();
//		}
	}

	// -----------------

	protected function getFieldGroup(): Component
	{
		foreach ($this->fields as $field) {
			if ($field instanceof Base === false) {
				continue;
			}

//			if ($field instanceof Range) {
//				return Slider::create();
//			}
//
//			if ($field instanceof InputMasked) {
//				return GroupMasked::create();
//			}
		}

		return Group::make();
	}

}