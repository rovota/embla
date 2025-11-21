@props(['name' => null])

<input type="file" {{ $attributes->merge(['id' => $name, 'name' => $name])->class('file') }}>