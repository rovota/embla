<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Illuminate\Support\Collection;
use Rovota\Embla\Components\Navigation\Tab;
use Rovota\Embla\Components\Navigation\TabAction;

final class TabsManager
{

	/**
	 * @var null|array<string, array{label: string, target: mixed}>
	 */
	public array|null $title = null;

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
		$this->title = [
			'label' => trim($label),
			'target' => $target,
		];
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