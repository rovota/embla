@props(['name', 'default' => null])

@php
	if (strlen($default ?? '') === 0) {
		$default = null;
	}
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