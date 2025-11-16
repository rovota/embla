@props(['name', 'default' => null])

<input type="range" {{ $attributes->merge(['id' => $name, 'name' => $name, 'value' => old($name, $default)])->class(['range']) }}>