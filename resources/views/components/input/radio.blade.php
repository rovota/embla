@aware(['default' => null])
@props(['name', 'value' => '1'])

@php
	$defaults = old(trim($name, '[]'), str_contains($default, '|') ? explode('|', $default) : $default);
	if (is_array($defaults) === false) {
		$defaults = [$defaults];
	}

	$checked = in_array($value, $defaults);
@endphp

<input type="radio" name="{{ $name }}" value="{{ $value }}" {{ $attributes->class('radio') }} @checked($checked)>