@aware(['name' => null])
@props(['default' => null, 'value'])

<textarea {{ $attributes->merge(['id' => $name, 'name' => $name]) }}>{{ $value ?? old($name, $default) }}</textarea>