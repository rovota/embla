@aware(['name' => null])
@props(['default' => null])

<input type="tel" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'autocomplete' => 'tel',
	'inputmode' => 'tel'
]) }}>