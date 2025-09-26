<placeholder {{ $attributes }}>
	@if($slot->isEmpty())
		<span>{{ __('There is nothing to show here.') }}</span>
	@else
		<span>{{ $slot }}</span>
	@endif
</placeholder>