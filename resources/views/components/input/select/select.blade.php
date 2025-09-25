@aware(['name' => null])
@props(['default' => null])

<select {{ $attributes->merge(['id' => $name, 'name' => $name]) }}>{{ $slot }}</select>