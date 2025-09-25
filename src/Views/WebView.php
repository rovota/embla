<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Views;

use Illuminate\Support\Str;
use Illuminate\View\Factory;
use Illuminate\View\View;
use Rovota\Embla\Views\Traits\WebFunctions;

class WebView extends View
{
	use WebFunctions;

	// -----------------

	protected string $template = 'public.entrance.index';

	// -----------------

	public function __construct()
	{
		$path = resource_path(sprintf('views/%s.blade.php', Str::replace('.', '/', $this->template)));

		parent::__construct(
			app('view'),
			app(Factory::class)->getEngineFromPath($path),
			$this->template,
			$path,

		);

		$this->configuration();
	}

	protected function configuration(): void
	{

	}

}