@aware(['name' => null])
@props(['default' => null])

@php
	foreach ($attributes as $key => $value) {
		if (in_array($key, ['value', 'min', 'max'])) {
			$attributes[$key] = moment($value)->format('Y-m-d H:i');
		}
	}
@endphp

<input type="datetime-local" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => moment(old($name, $default))->format('Y-m-d H:i')
]) }}>