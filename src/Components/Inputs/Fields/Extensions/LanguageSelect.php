<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields\Extensions;

use Rovota\Embla\Components\Inputs\Elements\Extensions\LanguageOption;
use Rovota\Embla\Components\Inputs\Fields\Select;
use Rovota\Embla\Utilities\Attributes\Autocomplete;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Localization\LanguageObject;

class LanguageSelect extends Select
{

	protected function configuration(): void
	{
		$this->title('Change language');
		$this->attribute('data-switch', 'locale');

		$this->name('language-switch');
		$this->autocomplete(Autocomplete::Off);

		$this->withForEach(Language::all(), function (LanguageObject $language) {
			return new LanguageOption()->using($language);
		});
	}

}