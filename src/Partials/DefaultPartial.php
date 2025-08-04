<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Partials;

use Rovota\Embla\Partials\Interfaces\PartialInterface;
use Rovota\Embla\Partials\Traits\PartialFunctions;
use Rovota\Framework\Support\Path;
use Rovota\Framework\Support\Str;
use Stringable;

class DefaultPartial implements Stringable, PartialInterface
{
	use PartialFunctions;

	// -----------------

	protected PartialConfig $config;

	protected string|null $template = null;

	// -----------------

	public function __construct(string|null $template, PartialConfig $config)
	{
		$this->config = $config;

		if ($template !== null) {
			$this->template = $template;
		}

		$this->configuration();
	}

	public function __toString(): string
	{
		$this->prepareForPrinting();
		$this->printContent();

		return '';
	}

	// -----------------

	public static function make(array $variables = []): static
	{
		$view = PartialManager::instance()->createPartial(null, static::class);

		foreach ($variables as $name => $value) {
			$view->with($name, $value);
		}

		return $view;
	}

	// -----------------

	protected function getTemplatePath(): string
	{
		$file = Str::replace($this->template, '.', '/');
		$file = Str::finish($file, '.php');
		$file = Str::start($file, 'resources/templates/partials/');

		return Path::toProjectFile($file);
	}

	// -----------------

	protected function printContent(): void
	{
		extract($this->config->array('variables'));
		$this->config->remove('variables');

		$template = $this->getTemplatePath();

		if (file_exists($template)) {
			include $template;
		}
	}

	protected function prepareForPrinting(): void
	{

	}

	protected function configuration(): void
	{

	}

}