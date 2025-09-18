<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

use Rovota\Embla\Components\Navigation\Tab;
use Rovota\Embla\Components\Navigation\TabAction;
use Rovota\Framework\Kernel\ServiceProvider;
use Rovota\Framework\Structures\Bucket;

final class TabsManager extends ServiceProvider
{

	/**
	 * @var null|array<string, array{label: string, target: mixed}>
	 */
	public array|null $title = null;

	/**
	 * @var Bucket<string, Tab>
	 */
	public Bucket $tabs {
		get => $this->tabs;
	}

	/**
	 * @var Bucket<string, TabAction>
	 */
	public Bucket $actions {
		get => $this->actions;
	}

	// -----------------

	public function __construct()
	{
		$this->tabs = new Bucket();
		$this->actions = new Bucket();
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
			$this->tabs->append($tab);
		}
	}

	public function addActions(array $actions): void
	{
		foreach ($actions as $action) {
			$this->actions->append($action);
		}
	}

}