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
	// Starters

	public static function default(string|null $label = null, array|object $data = []): static
	{
		return self::label($label ?? '---', $data)->selected();
	}

	public static function label(string $text, array|object $data = []): static
	{
		return (new static)->withTranslated($text, $data);
	}

	public static function labelFromModel(Model $model): static
	{
		return (new static)->withTranslated((string) $model);
	}

	// -----------------
	// Content

	public function value(mixed $value): static
	{
		return $this->attribute('value', (string) $value);
	}

	// -----------------
	// Interactivity

	public function selected(): static
	{
		return $this->attribute('selected');
	}

	public function disabled(): static
	{
		return $this->attribute('disabled');
	}

}