<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Utilities\Attributes\InputType;

class Phone extends Base
{

	protected function configuration(): void
	{
		if ($this->attributes->missing('type')) {
			$this->type(InputType::Tel);
		}
	}

	// -----------------
	// Constraints

	public function pattern(string $pattern): static
	{
		return $this->attribute('pattern', $pattern);
	}

}