<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Collection;
use Illuminate\Support\Fluent;

final class TabsManager
{

	public Fluent|null $title = null;

	/**
	 * @var Collection<string, Tab>
	 */
	public Collection $tabs {
		get => $this->tabs;
	}

	/**
	 * @var Collection<string, TabAction>
	 */
	public Collection $actions {
		get => $this->actions;
	}

	// -----------------

	public function __construct()
	{
		$this->tabs = new Collection();
		$this->actions = new Collection();
	}

	// -----------------

	public function setTitle(string $label, mixed $target = null): void
	{
		$this->title = new Fluent([
			'label' => trim($label),
			'target' => $target,
		]);
	}

	// -----------------

	public function addTabs(array $tabs): void
	{
		foreach ($tabs as $tab) {
			$this->tabs->add($tab);
		}
	}

	public function addActions(array $actions): void
	{
		foreach ($actions as $action) {
			$this->actions->add($action);
		}
	}

}