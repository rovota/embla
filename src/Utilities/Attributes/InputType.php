<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Attributes;

enum InputType: string
{

	case Checkbox = 'checkbox';
	case Color = 'color';
	case Date = 'date';
	case DateTime = 'datetime-local';
	case Email = 'email';
	case File = 'file';
	case Hidden = 'hidden';
	case Month = 'month';
	case Number = 'number';
	case Password = 'password';
	case Radio = 'radio';
	case Range = 'range';
	case Reset = 'reset';
	case Search = 'search';
	case Submit = 'submit';
	case Tel = 'tel';
	case Text = 'text';
	case Time = 'time';
	case Url = 'url';
	case Week = 'week';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			InputType::Checkbox => 'Checkbox',
			InputType::Color => 'Color',
			InputType::Date => 'Date',
			InputType::DateTime => 'DateTime',
			InputType::Email => 'Email',
			InputType::File => 'File',
			InputType::Hidden => 'Hidden',
			InputType::Month => 'Month',
			InputType::Number => 'Number',
			InputType::Password => 'Password',
			InputType::Radio => 'Radio',
			InputType::Range => 'Range',
			InputType::Reset => 'Reset',
			InputType::Search => 'Search',
			InputType::Submit => 'Submit',
			InputType::Tel => 'Tel',
			InputType::Text => 'Text',
			InputType::Time => 'Time',
			InputType::Url => 'Url',
			InputType::Week => 'Week',
		};
	}
}