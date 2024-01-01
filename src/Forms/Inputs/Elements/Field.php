<?php

/**
 * @author      Software Department <developers@rovota.com>
 * @copyright   Copyright (c), Rovota
 * @license     MIT
 */

namespace Rovota\Embla\Forms\Inputs\Elements;

use Rovota\Embla\Forms\Inputs\Fields\Checkbox;
use Rovota\Embla\Forms\Inputs\Fields\Csrf;
use Rovota\Embla\Forms\Inputs\Fields\Date;
use Rovota\Embla\Forms\Inputs\Fields\DateTime;
use Rovota\Embla\Forms\Inputs\Fields\Email;
use Rovota\Embla\Forms\Inputs\Fields\File;
use Rovota\Embla\Forms\Inputs\Fields\Hidden;
use Rovota\Embla\Forms\Inputs\Fields\Month;
use Rovota\Embla\Forms\Inputs\Fields\Number;
use Rovota\Embla\Forms\Inputs\Fields\OneTimeCode;
use Rovota\Embla\Forms\Inputs\Fields\Panel;
use Rovota\Embla\Forms\Inputs\Fields\Password;
use Rovota\Embla\Forms\Inputs\Fields\Phone;
use Rovota\Embla\Forms\Inputs\Fields\Radio;
use Rovota\Embla\Forms\Inputs\Fields\Range;
use Rovota\Embla\Forms\Inputs\Fields\Search;
use Rovota\Embla\Forms\Inputs\Fields\Select;
use Rovota\Embla\Forms\Inputs\Fields\Text;
use Rovota\Embla\Forms\Inputs\Fields\Textarea;
use Rovota\Embla\Forms\Inputs\Fields\Time;
use Rovota\Embla\Forms\Inputs\Fields\Toggle;
use Rovota\Embla\Forms\Inputs\Fields\Url;
use Rovota\Embla\Forms\Inputs\Fields\Week;

class Field
{

	protected function __construct()
	{
	}

	// -----------------

	public static function checkbox(): Checkbox
	{
		return Checkbox::create();
	}

	public static function csrf(): Csrf
	{
		return Csrf::create();
	}

	public static function date(): Date
	{
		return Date::create();
	}

	public static function datetime(): DateTime
	{
		return DateTime::create();
	}

	public static function email(): Email
	{
		return Email::create();
	}

	public static function file(): File
	{
		return File::create();
	}

	public static function hidden(): Hidden
	{
		return Hidden::create();
	}

	public static function month(): Month
	{
		return Month::create();
	}

	public static function number(): Number
	{
		return Number::create();
	}

	public static function oneTimeCode(): OneTimeCode
	{
		return OneTimeCode::create();
	}

	public static function password(): Password
	{
		return Password::create();
	}

	public static function panel(): Panel
	{
		return Panel::create();
	}

	public static function phone(): Phone
	{
		return Phone::create();
	}

	public static function radio(): Radio
	{
		return Radio::create();
	}

	public static function range(): Range
	{
		return Range::create();
	}

	public static function search(): Search
	{
		return Search::create();
	}

	public static function select(): Select
	{
		return Select::create();
	}

	public static function textarea(): Textarea
	{
		return Textarea::create();
	}

	public static function text(): Text
	{
		return Text::create();
	}

	public static function time(): Time
	{
		return Time::create();
	}

	public static function toggle(): Toggle
	{
		return Toggle::create();
	}

	public static function url(): Url
	{
		return Url::create();
	}

	public static function week(): Week
	{
		return Week::create();
	}

}