@aware(['name' => null])
@props(['default' => null])

@php
	if (strlen($default ?? '') === 0) {
		$default = null;
	}
	foreach ($attributes as $key => $value) {
		if (in_array($key, ['value', 'min', 'max'])) {
			$attributes[$key] = moment($value)->format('Y-m-d');
		}
	}
@endphp

<input type="date" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default) !== null ? moment(old($name, $default))->format('Y-m-d') : ''
]) }}>