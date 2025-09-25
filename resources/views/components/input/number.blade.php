@aware(['name' => null])
@props(['default' => null])

<input type="number" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'inputmode' => 'numeric'
]) }}>