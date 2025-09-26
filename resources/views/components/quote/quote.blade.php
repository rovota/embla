@props(['source'])

<info @isset($source)cite="{{ __($source) }}"@endisset {{ $attributes }}>
	<p>{{ $slot }}</p>
</info>