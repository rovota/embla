<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Fields;

use Rovota\Core\Support\Str;
use Rovota\Embla\Forms\Inputs\Enums\InputType;

class File extends Base
{

	public function __construct()
	{
		parent::__construct();

		if (isset($this->attributes['type']) === false) {
			$this->type(InputType::File);
		}

		$this->captions(['Select file(s)', '%1$s files selected']);
	}

	// -----------------
	// Content

	public function captions(array $caption): static
	{
		$this->missingFileCaption($caption[0]);
		$this->selectedFileCaption($caption[1]);
		return $this;
	}

	public function missingFileCaption(string $caption, array|object $args = []): static
	{
		$this->attribute('data-missingcaption', Str::translate($caption, $args));
		return $this;
	}

	public function selectedFileCaption(string $caption, array|object $args = []): static
	{
		$this->attribute('data-selectedcaption', Str::translate($caption, $args));
		return $this;
	}

	// -----------------
	// Constraints

	public function allowTypes(array|string $types): static
	{
		$specifiers = match(true) {
			is_string($types) => text($types)->remove(' ')->explode(','),
			default => $types,
		};
		$this->attribute('accept', implode(',', $specifiers));
		return $this;
	}

	// -----------------
	// Interactivity

	public function capture(string $view): static
	{
		$view = match($view) {
			'front' => 'user',
			'rear' => 'environment',
			default => trim($view),
		};
		$this->attribute('capture', $view);
		return $this;
	}

	public function allowMultiple(): static
	{
		$this->attribute('multiple');
		return $this;
	}

}