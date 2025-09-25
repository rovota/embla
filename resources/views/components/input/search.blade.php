@aware(['name' => null])
@props(['default' => null])

<input type="search" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'inputmode' => 'search'
]) }}>