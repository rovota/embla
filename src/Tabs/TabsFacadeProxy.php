<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Tabs;

final class TabsFacadeProxy
{

	protected TabsManager $manager;

	public function __construct(TabsManager $manager)
	{
		$this->manager = $manager;
	}

	public function title(string $label, mixed $target = null): void
	{
		$this->manager->setTitle($label, $target);
	}

	public function register(array $tabs): void
	{
		$this->manager->addTabs($tabs);
	}

	public function actions(array $actions): void
	{
		$this->manager->addActions($actions);
	}

}