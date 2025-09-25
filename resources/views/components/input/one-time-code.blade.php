@aware(['name' => null])
@props(['default' => null, 'length' => 6])

<input type="number" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
	'autocomplete' => 'one-time-code',
	'inputmode' => 'numeric',
	'pattern' => '[0-9]{' . $length . '}',
	'placeholder' => str_repeat('0', $length)
]) }}>