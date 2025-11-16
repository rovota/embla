@props(['name', 'default' => null])

<input type="text" {{ $attributes->merge(['id' => $name, 'name' => $name, 'value' => old($name, $default)]) }}>