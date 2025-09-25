@aware(['name' => null])
@props(['default' => null])

<input type="password" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'autocomplete' => 'current-password',
	'minlength' => 10,
	'maxlength' => 200,
	'capitalize' => 'off'
]) }}>