<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Toolbar;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

final class ToolbarManager
{

	public Fluent|null $title = null;

	/**
	 * @var Collection<string, ToolbarAction>
	 */
	public Collection $actions {
		get => $this->actions;
	}

	// -----------------

	public function __construct()
	{
		$this->actions = new Collection();
	}

	// -----------------

	public function setTitle(string $label, mixed $data = null): void
	{
		$this->title = new Fluent([
			'label' => trim($label),
			'data' => $data,
		]);
	}

	// -----------------

	public function addActions(array $actions): void
	{
		foreach ($actions as $action) {
			$this->actions->add($action);
		}
	}

}