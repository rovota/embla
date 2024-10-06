<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Fields\Extensions;

use Rovota\Embla\Components\Inputs\Elements\Extensions\LanguageOption;
use Rovota\Embla\Components\Inputs\Fields\Select;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Localization\LanguageObject;

class LanguageSelect extends Select
{

	protected function configuration(): void
	{
		$this->title('Change language');
		$this->attribute('locale-switch');

		$this->withForEach(Language::all(), function (LanguageObject $language) {
			return LanguageOption::from($language);
		});
	}

}