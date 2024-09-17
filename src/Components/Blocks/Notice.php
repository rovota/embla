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

	public static function status(string $content, Status|string $status = Status::Info): static
	{
		if (is_string($status)) {
			$status = Status::tryFrom($status) ?? Status::Info;
		}

		$component = self::content($content);
		$component->icon('level.'.$status->value);
		$component->accent($status);

		return $component;
	}

	public static function content(string $text, array|object $data = []): static
	{
		$component = new static;
		$component->with('', 'icon');
		$component->with(Content::make()->withTranslated($text, $data));

		return $component;
	}

	// -----------------
	// Content

	public function icon(string $name): static
	{
		return $this->with(icon($name), 'icon');
	}

}