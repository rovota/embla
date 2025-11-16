@aware(['default' => null])
@props(['name', 'value' => '1', 'fallback' => 'on'])

@php
	$defaults = old(trim($name, '[]'), str_contains($default, '|') ? explode('|', $default) : $default);
	if (is_array($defaults) === false) {
		$defaults = [$defaults];
	}

	$checked = in_array($value, $defaults);
@endphp

@if($fallback === 'on')
	<input type="hidden" name="{{ $name }}" value="0">
@endif

<input type="checkbox" name="{{ $name }}" value="{{ $value }}" {{ $attributes->class('checkbox') }} @checked($checked)>