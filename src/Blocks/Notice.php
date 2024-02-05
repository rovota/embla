<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Blocks;

use Rovota\Embla\Appearance\Enums\StatusLevel;
use Rovota\Embla\Component;
use Rovota\Embla\Wrappers\Content;
use function Rovota\Embla\Iconography\icon;

class Notice extends Component
{

	public function __construct()
	{
		parent::__construct('notice');
	}

	// -----------------
	// Content

	public static function status(string $content, StatusLevel|string $status = StatusLevel::Info): static
	{
		if (is_string($status)) {
			$status = StatusLevel::tryFrom($status) ?? StatusLevel::Info;
		}
		$component = self::content($content);
		$component->accent($status);
		$component->icon('level.'.$status->value);
		return $component;
	}

	public static function content(string $content, array|object $args = []): static
	{
		$component = new static;
		$component->with('', 'icon');
		$component->with(Content::create()->withText($content, $args));
		return $component;
	}

	public function icon(string $icon, string|null $set = null): static
	{
		if (function_exists('Rovota\Embla\Iconography\icon')) {
			$icon = icon($icon, $set);
		}
		$this->with(trim($icon), 'icon');
		return $this;
	}

}