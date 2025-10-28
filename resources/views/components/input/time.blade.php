@aware(['name' => null])
@props(['default' => null])

@php
	foreach ($attributes as $key => $value) {
		if (in_array($key, ['value', 'min', 'max'])) {
			$attributes[$key] = moment($value)->format('H:i');
		}
	}
@endphp

<input type="time" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default) !== null ? moment(old($name, $default))->format('Y-\WW') : ''
]) }}>