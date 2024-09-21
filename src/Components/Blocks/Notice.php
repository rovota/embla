<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Blocks;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Components\Layout\Content;
use Rovota\Embla\Utilities\Colors\Status;

class Notice extends Component
{

	protected function configuration(): void
	{
		$this->config->tag = 'notice';
	}

	// -----------------
	// Starters

	public static function status(Status|string $status = Status::Info): static
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

		$component = new static;
		$component->icon($icon);
		$component->accent($status);

		return $component;
	}

	public static function simple(string $text, array|object $data = []): static
	{
		$component = new static;
		$component->with('', 'icon');
		$component->content($text, $data);

		return $component;
	}

	// -----------------
	// Content

	public function content(string $text, array|object $data = []): static
	{
		return $this->with(Content::make()->withTranslated($text, $data));
	}

	public function icon(string $name): static
	{
		return $this->with(icon($name), 'icon');
	}

}