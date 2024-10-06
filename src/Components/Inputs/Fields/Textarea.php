<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Base\Component;

class Textarea extends Base
{

	public function __construct(Component|null $parent = null)
	{
		parent::__construct($parent);

		$this->config->tag = 'textarea';
	}

	protected function configuration(): void
	{
		$this->rows(6);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		return $this->withEscaped($value);
	}

	// -----------------
	// Appearance

	public function columns(int $number): static
	{
		return $this->attribute('cols', abs($number));
	}

	public function rows(int $number): static
	{
		return $this->attribute('rows', abs($number));
	}

}