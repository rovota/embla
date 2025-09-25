@aware(['name' => null])
@props(['default' => null])

<input type="url" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'autocomplete' => 'url',
	'inputmode' => 'url'
]) }}>