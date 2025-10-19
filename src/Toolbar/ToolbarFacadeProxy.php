<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Toolbar;

final class ToolbarFacadeProxy
{

	protected ToolbarManager $manager;

	public function __construct(ToolbarManager $manager)
	{
		$this->manager = $manager;
	}

	public function title(string $label, mixed $data = null): void
	{
		$this->manager->setTitle($label, $data);
	}

	public function actions(array $actions): void
	{
		$this->manager->addActions($actions);
	}

}