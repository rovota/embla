@props(['source'])

<info @isset($source)cite="{{ __($source) }}"@endisset {{ $attributes }}>
	{{ $slot }}
</info>