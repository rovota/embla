@props(['name', 'default' => null, 'value' => null])

<textarea {{ $attributes->merge(['id' => $name, 'name' => $name]) }}>{{ $value ?? old($name, $default) }}</textarea>