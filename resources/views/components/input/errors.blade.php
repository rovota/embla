@props(['field'])

@error($field)
<input-errors>
	@foreach ($errors->get($field) as $message)
		<span>{{ __($message) }}</span>
	@endforeach
</input-errors>
@enderror