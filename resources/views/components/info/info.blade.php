@props(['caption'])

<info @isset($caption)caption="{{ __($caption) }}"@endisset {{ $attributes }}>
	<p>{{ $slot }}</p>
</info>