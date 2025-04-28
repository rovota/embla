<?php

/**
 * @copyright   Léandro Tijink
 * @license     MIT
 */

namespace Rovota\Embla\Utilities\Attributes;

enum Autocomplete: string
{

	case Off = 'off';
	case On = 'on';
	case Name = 'name';
	case HonorificPrefix = 'honorific-prefix';
	case GivenName = 'given-name';
	case AdditionalName = 'additional-name';
	case FamilyName = 'family-name';
	case HonorificSuffix = 'honorific-suffix';
	case Nickname = 'nickname';
	case Email = 'email';
	case Username = 'username';
	case NewPassword = 'new-password';
	case CurrentPassword = 'current-password';
	case OneTimeCode = 'one-time-code';
	case OrganizationTitle = 'organization-title';
	case Organization = 'organization';
	case StreetAddress = 'street-address';
	case Country = 'country';
	case CountryName = 'country-name';
	case PostalCode = 'postal-code';
	case CardName = 'cc-name';
	case CardGivenName = 'cc-given-name';
	case CardAdditional = 'cc-additional-name';
	case CardFamily = 'cc-family-name';
	case CardNumber = 'cc-number';
	case CardExpiry = 'cc-exp';
	case CardExpiryMonth = 'cc-exp-month';
	case CardExpiryYear = 'cc-exp-year';
	case CardCsc = 'cc-csc';
	case CardType = 'cc-type';
	case TransactionCurrency = 'transaction-currency';
	case TransactionAmount = 'transaction-amount';
	case Language = 'language';
	case Birthday = 'bday';
	case BirthdayDay = 'bday-day';
	case BirthdayMonth = 'bday-month';
	case BirthdayYear = 'bday-year';
	case Sex = 'sex';
	case Phone = 'tel';
	case PhoneCountryCode = 'tel-country-code';
	case PhoneNational = 'tel-national';
	case PhoneAreaCode = 'tel-area-code';
	case PhoneLocal = 'tel-local';
	case PhoneExtension = 'tel-extension';
	case Url = 'url';
	case Photo = 'photo';

	// -----------------

	public function label(): string
	{
		return match ($this) {
			Autocomplete::Off => 'Disabled',
			Autocomplete::On => 'Enabled',
			Autocomplete::Name => 'Name',
			Autocomplete::HonorificPrefix => 'Honorific prefix',
			Autocomplete::GivenName => 'Given name',
			Autocomplete::AdditionalName => 'Additional name',
			Autocomplete::FamilyName => 'Family name',
			Autocomplete::HonorificSuffix => 'Honorific suffix',
			Autocomplete::Nickname => 'Nickname',
			Autocomplete::Email => 'Email',
			Autocomplete::Username => 'Username',
			Autocomplete::NewPassword => 'New password',
			Autocomplete::CurrentPassword => 'Current password',
			Autocomplete::OneTimeCode => 'One-time-code',
			Autocomplete::OrganizationTitle => 'Organization title',
			Autocomplete::Organization => 'Organization',
			Autocomplete::StreetAddress => 'Street address',
			Autocomplete::Country => 'Country',
			Autocomplete::CountryName => 'Country name',
			Autocomplete::PostalCode => 'Postal code',
			Autocomplete::CardName => 'Card name',
			Autocomplete::CardGivenName => 'Card given name',
			Autocomplete::CardAdditional => 'Card additional name',
			Autocomplete::CardFamily => 'Card family name',
			Autocomplete::CardNumber => 'Card number',
			Autocomplete::CardExpiry => 'Card expiry',
			Autocomplete::CardExpiryMonth => 'Card expiry (month)',
			Autocomplete::CardExpiryYear => 'Card expiry (year)',
			Autocomplete::CardCsc => 'Card CSC',
			Autocomplete::CardType => 'Card type',
			Autocomplete::TransactionCurrency => 'Transaction currency',
			Autocomplete::TransactionAmount => 'Transaction amount',
			Autocomplete::Language => 'Language',
			Autocomplete::Birthday => 'Birthday',
			Autocomplete::BirthdayDay => 'Birthday (day)',
			Autocomplete::BirthdayMonth => 'Birthday (month)',
			Autocomplete::BirthdayYear => 'Birthday (year)',
			Autocomplete::Sex => 'Sex',
			Autocomplete::Phone => 'Phone',
			Autocomplete::PhoneCountryCode => 'Phone country-code',
			Autocomplete::PhoneNational => 'Phone (national)',
			Autocomplete::PhoneAreaCode => 'Phone area-code',
			Autocomplete::PhoneLocal => 'Phone (local)',
			Autocomplete::PhoneExtension => 'Phone extension',
			Autocomplete::Url => 'url',
			Autocomplete::Photo => 'photo',
		};
	}
}