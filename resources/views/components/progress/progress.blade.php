@props(['label', 'status', 'precision', 'suffix'])

<progress-group>
	@isset($label)
		<span>
			{{ __($label) }}
			@if($attributes->has(['value', 'max']))
				<small>
					@if(isset($suffix) && $suffix === '%')
						{{ Number::format((100 / $attributes->get('max') * $attributes->get('value')), $precision ?? 0) }}%
					@else
						{{ Number::format($attributes->get('value'), $precision ?? 0) }}
						@if(isset($suffix)){{ $suffix }}@else / {{ Number::format($attributes->get('max'), $precision ?? 0) }}@endif
					@endif
				</small>
			@endif
		</span>
	@endisset
	<x-embla::progress.bar {{ $attributes->only(['dynamic', 'value', 'max']) }} />
</progress-group>