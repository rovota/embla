@aware(['name' => null])
@props(['default' => null])

<input type="range" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
])->class(['input-range', 'masked']) }}>