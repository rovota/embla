@props(['default' => '/'])

<a {{ $attributes->merge(['href' => url()->previous($default)]) }}>{{ $slot }}</a>