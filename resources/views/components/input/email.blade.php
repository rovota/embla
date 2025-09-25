@aware(['name' => null])
@props(['default' => null])

<input type="email" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'autocomplete' => 'email',
	'inputmode' => 'email'
]) }}>