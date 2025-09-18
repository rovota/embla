<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Base\Extensions;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Utilities\Attributes\InputType;
use Rovota\Framework\Facades\Cast;
use Rovota\Framework\Support\Str;

class InputComponent extends Component
{

	public function type(InputType|string $type): static
	{
		return $this->attribute('type', $type);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		if ($value !== null) {
			$value = Cast::toRawAutomatic($value);

			if (strlen((string)$value) > 0) {
				$this->attribute('value', $value);
			}
		}

		return $this;
	}

	public function placeholder(string $value, array $data = []): static
	{
		return $this->attribute('placeholder', Str::translate($value, $data));
	}

	// -----------------
	// Interactivity

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