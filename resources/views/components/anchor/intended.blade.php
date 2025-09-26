@props(['default' => '/'])

<a {{ $attributes->merge(['href' => Session::get('url.intended', $default)]) }}>{{ $slot }}</a>