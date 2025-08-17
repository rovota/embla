<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields;

use Rovota\Embla\Base\Component;
use Rovota\Embla\Base\Extensions\InputComponent;
use Rovota\Embla\Components\Inputs\Traits\InputCommons;
use Rovota\Embla\Utilities\Attributes\InputType;

abstract class Base extends InputComponent
{
	use InputCommons;

	// -----------------

	public function __construct(Component|null $parent = null)
	{
		parent::__construct($parent);

		$this->config->tag = 'input';
	}

	// -----------------

	protected function prepareRender(): void
	{
		if ($this->attributes->missing('type') && $this->config->tag === 'input') {
			$this->type(InputType::Text);
		}
	}

	// -----------------

	public function synchronize(array|string $trigger, string|array $directive = []): static
	{
		if (is_array($trigger)) {
			foreach ($trigger as $key => $value) {
				$this->synchronize($key, $value);
			}
			return $this;
		}

		if (is_array($directive)) {
			$directive = implode(':', $directive);
		}

		if (strlen($directive) > 1 && str_contains($directive, ':')) {
			$value = sprintf('%s[%s]', $trigger, $directive);

			if ($this->attributes->missing('data-sync')) {
				$this->attributes->set('data-sync', $value);
			} else {
				$this->attributes->set('data-sync', sprintf('%s&%s', $this->attributes->get('data-sync'), $value));
			}
		}

		return $this;
	}
}