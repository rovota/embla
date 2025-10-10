@props(['name' => null, 'default' => null])

<input type="hidden" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default)
]) }}>