@props(['label'])

<optgroup label="{{ __($label) }}" {{ $attributes }}>{{ $slot }}</optgroup>