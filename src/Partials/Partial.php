<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Embla\Partials\Traits\PartialFunctions;
use Rovota\Framework\Support\Path;
use Rovota\Framework\Support\Str;
use Stringable;

class Partial implements Stringable
{
	use PartialFunctions;

	// -----------------

	protected PartialConfig $config;

	protected string|null $template = null;

	// -----------------

	public function __construct(string|null $template = null)
	{
		$this->config = new PartialConfig();

		if ($template !== null) {
			$this->template = $template;
		}

		$this->configuration();
	}

	public function __toString(): string
	{
		$this->prepareData();
		$this->prepareRendering();
		$this->render();

		return '';
	}

	// -----------------

	protected function prepareData(): void
	{
		$this->config->merge(PartialManager::instance()->retrieveData());
	}

	protected function prepareRendering(): void
	{

	}

	protected function configuration(): void
	{

	}

	// -----------------

	protected function render(): void
	{
		extract($this->config->array('variables'));

		$template = $this->getTemplatePath();

		if (file_exists($template)) {
			include $template;
		}
	}

	protected function getTemplatePath(): string
	{
		$file = Str::replace($this->template, '.', '/');
		$file = Str::finish($file, '.php');
		$file = Str::start($file, 'resources/templates/partials/');

		return Path::toProjectFile($file);
	}

}