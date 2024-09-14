<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Legacy\Typography;

use Rovota\Embla\Legacy\Component;

class Heading extends Component
{

	public function __construct()
	{
		parent::__construct('h2');
	}

	// -----------------
	// Content

	public static function text(string $text, array|object $args = []): static
	{
		$component = new static;
		$component->withText($text, $args);
		return $component;
	}

	// -----------------
	// Levels

	public function h1(): static
	{
		$this->config->set('tag', 'h1');
		return $this;
	}

	public function h2(): static
	{
		$this->config->set('tag', 'h2');
		return $this;
	}

	public function h3(): static
	{
		$this->config->set('tag', 'h3');
		return $this;
	}

	public function h4(): static
	{
		$this->config->set('tag', 'h4');
		return $this;
	}

	public function h5(): static
	{
		$this->config->set('tag', 'h5');
		return $this;
	}

}