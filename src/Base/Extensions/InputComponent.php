<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Extensions;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Facades\Cast;

class InputComponent extends Component
{

	public function type(InputType|string $type): static
	{
		return $this->attribute('type', $type);
	}

	public function id(string|int $id): static
	{
		return $this->attribute('id', $id);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if ($value !== null) {
			$value = Cast::toRawAutomatic($value);

			if (strlen((string)$value) > 0) {
				$this->attributeEscaped('value', $value);
			}
		}

		return $this;
	}

	public function placeholder(string $value, array $data = []): static
	{
		return $this->attributeTranslated('placeholder', $value, $data);
	}

	// -----------------
	// Interactivity`

	public function disabled(): static
	{
		return $this->attribute('disabled');
	}

	public function autoFocus(): static
	{
		return $this->attribute('autofocus');
	}

	// -----------------
	// Constraints

	public function required(): static
	{
		return $this->attribute('required');
	}

	public function readonly(): static
	{
		return $this->attribute('readonly');
	}

}