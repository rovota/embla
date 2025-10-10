@props(['directive'])

<a href="/" {{ $attributes->merge(['data-message' => $directive]) }}>{{ $slot }}</a>