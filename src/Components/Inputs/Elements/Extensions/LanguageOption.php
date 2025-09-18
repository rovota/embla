<?php
/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Components\Inputs\Elements\Extensions;

use Rovota\Embla\Components\Inputs\Elements\Option;
use Rovota\Framework\Facades\Language;
use Rovota\Framework\Localization\LanguageObject;

class LanguageOption extends Option
{

	// -----------------
	// Content

	public function using(LanguageObject $language): static
	{
		return $this->label($language->label())->value($language->locale)->when($language->locale === Language::active()->locale, function (Option $option) {
			return $option->selected();
		});
	}

}