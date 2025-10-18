@props(['source'])

<blockquote @isset($source)cite="{{ __($source) }}"@endisset {{ $attributes }}>
	{{ $slot }}
</blockquote>