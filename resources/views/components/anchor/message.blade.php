@props(['message'])

<a {{ $attributes->merge(['data-message' => $message]) }}>{{ $slot }}</a>