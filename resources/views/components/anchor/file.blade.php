@props(['location', 'disk' => Storage::getDefaultDriver()])

<a {{ $attributes->merge(['href' => Storage::disk($disk)->url($location)]) }}>{{ $slot }}</a>