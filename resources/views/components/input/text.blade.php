@aware(['name' => null, 'slugify'])
@props(['default' => null])

<input type="text" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'value' => old($name, $default),
]) }} @isset($slugify) slugify @endisset>