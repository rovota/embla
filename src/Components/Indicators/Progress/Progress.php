<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Indicators\Progress;

use Rovota\Embla\Components\Component;
use Rovota\Embla\Data\Colors\Status;

class Progress extends Component
{

	public string $tag = 'progress';

	// -----------------
	// Appearance

	public function total(int|float $number): static
	{
		$this->attribute('max', abs($number));
		return $this;
	}

	public function current(int|float $number): static
	{
		$this->attribute('value', abs($number));
		return $this;
	}

	public function accentByInterval(): static
	{
		$intervals = [
			0 => Status::Success,
			60 => Status::Warning,
			90 => Status::Danger,
		];

		if ($this->attributes->has('value')) {
			foreach ($intervals as $interval => $status) {
				if ((int)$this->attributes->get('value') >= $interval) {
					$this->accent($status);
				}
			}
		}

		return $this;
	}

}