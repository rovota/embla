@props(['name', 'default' => null])

<input type="password" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'minlength' => 10,
	'maxlength' => 200,
	'capitalize' => 'off'
]) }}>