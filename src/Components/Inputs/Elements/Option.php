<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements;

use Rovota\Embla\Base\Component;
use Rovota\Framework\Database\Model\Model;

class Option extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'option';
	}

	// -----------------
	// Content

	public function default(string|null $label = null, array|object $data = []): static
	{
		return $this->label($label ?? '---', $data)->selected();
	}

	public function label(string $text, array|object $data = []): static
	{
		return $this->withTranslated($text, $data);
	}

	public function labelFromModel(Model $model): static
	{
		return $this->withTranslated((string)$model);
	}

	public function value(mixed $value): static
	{
		return $this->attribute('value', (string)$value);
	}

	// -----------------
	// Interactivity

	public function selectedIf(bool $condition): static
	{
		return $condition ? $this->selected() : $this;
	}

	public function selected(): static
	{
		return $this->attribute('selected');
	}

}