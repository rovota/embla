<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Rovota\Embla\Components\Navigation\Tab;
use Rovota\Embla\Components\Navigation\TabAction;
use Rovota\Framework\Kernel\ServiceProvider;

final class TabsManager extends ServiceProvider
{

	/**
	 * @var null|array<string, mixed>
	 */
	protected array|null $title = null;

	/**
	 * @var array<string, Tab>
	 */
	protected array $tabs = [];

	/**
	 * @var array<int, TabAction>
	 */
	protected array $actions = [];

	// -----------------

	public function __construct()
	{
	}

	// -----------------

	public function hasTitle(): bool
	{
		return $this->title !== null;
	}

	public function setTitle(string $label, mixed $target = null): void
	{
		$this->title = [
			'label' => trim($label),
			'target' => $target,
		];
	}

	public function getTitle(): array|null
	{
		return $this->title;
	}

	// -----------------

	public function hasTabs(): bool
	{
		return empty($this->tabs) === false;
	}

	public function addTabs(array $tabs): void
	{
		foreach ($tabs as $tab) {
			$this->tabs[] = $tab;
		}
	}

	public function getTabs(): array
	{
		return $this->tabs;
	}

	// -----------------

	public function hasActions(): bool
	{
		return empty($this->actions) === false;
	}

	public function addActions(array $actions): void
	{
		foreach ($actions as $action) {
			$this->actions[] = $action;
		}
	}

	public function getActions(): array
	{
		return $this->actions;
	}

}