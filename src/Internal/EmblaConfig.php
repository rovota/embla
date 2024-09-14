<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Internal;

use Rovota\Framework\Structures\Bucket;
use Rovota\Framework\Support\Config;

/**
 * @internal
 *
 * @property-read array $icon_sources
 */
class EmblaConfig extends Config
{

	// -----------------

	protected function getIconSources(): array
	{
		return Bucket::from($this->array('icons.sources'))->filter(function (string $path) {
			return file_exists($path);
		})->toArray();
	}

	// -----------------

	// -----------------

	// -----------------

	// -----------------

	// -----------------

	// -----------------

}