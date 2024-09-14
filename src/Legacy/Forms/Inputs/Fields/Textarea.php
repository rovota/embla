<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Forms\Inputs\Fields;

class Textarea extends Base
{

	public function __construct()
	{
		parent::__construct('textarea');

		$this->rows(6);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		$this->with(e($value));
		return $this;
	}

	// -----------------
	// Appearance

	public function columns(int $number): static
	{
		$this->attribute('cols', abs($number));
		return $this;
	}

	public function rows(int $number): static
	{
		$this->attribute('rows', abs($number));
		return $this;
	}

}