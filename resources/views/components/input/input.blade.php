@props(['name', 'errors', 'label', 'slugify', 'counter'])

<input-group {{ $attributes }}>
	@isset($label)
		<label for="{{ $name }}">{{ __($label) }}</label>
	@endisset

	@if($slot->isNotEmpty())
		<input-box>
			{{ $slot }}
		</input-box>
	@endif

	@isset($slugify)
		<input-note>{{ __('Slug') }}: /<span></span></input-note>
	@endisset

	@isset($counter)
		<input-note>{{ __('Characters') }}: <charcount></charcount> / <charlimit></charlimit></input-note>
	@endisset

	@isset($note)
		<input-note>{{ $note }}</input-note>
	@endisset

	@error($name)
		<input-errors>
			@foreach ($errors->get($name) as $message)
				<span>{{ __($message) }}</span>
			@endforeach
		</input-errors>
	@enderror
</input-group>