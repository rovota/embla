<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Rovota\Embla\Components\Component;
use Rovota\Embla\Components\Layout\Content;
use Rovota\Embla\Data\Colors\Status;

class Notice extends Component
{

	public string $tag = 'notice';

	// -----------------

	protected function configuration(): void
	{
		$this->with('', 'icon');
	}

	// -----------------
	// Content

	public function content(string $text, array|object $data = []): static
	{
		return $this->with(new Content()->withTranslated($text, $data));
	}

	public function icon(string $name): static
	{
		return $this->with(icon($name), 'icon');
	}

	// -----------------
	// Appearance

	public function status(Status|string $status = Status::Info): static
	{
		if (is_string($status)) {
			$status = Status::tryFrom($status) ?? Status::Info;
		}

		$icon = match ($status) {
			Status::Info => 'symbols.info-circle',
			Status::Success => 'symbols.check-circle',
			Status::Warning => 'symbols.alert-triangle',
			Status::Danger => 'symbols.alert-octagon',
		};

		return $this->icon($icon)->accent($status);
	}

}