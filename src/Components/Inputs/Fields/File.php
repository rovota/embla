<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Support\Str;

class File extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
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

	public function missingFileCaption(string $caption, array|object $data = []): static
	{
		return $this->attribute('data-missingcaption', Str::translate($caption, $data));
	}

	public function selectedFileCaption(string $caption, array|object $data = []): static
	{
		return $this->attribute('data-selectedcaption', Str::translate($caption, $data));
	}

	// -----------------
	// Constraints

	public function allowTypes(array|string $types): static
	{
		$specifiers = match(true) {
			is_string($types) => text($types)->remove(' ')->explode(','),
			default => $types,
		};

		return $this->attribute('accept', implode(',', $specifiers));
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

		return $this->attribute('capture', $view);
	}

	public function allowMultiple(): static
	{
		return $this->attribute('multiple');
	}

}