@props(['icon', 'status'])

@php
    if (isset($status)) {
		$attributes = $attributes->class(['accent-' . $status]);

		if (isset($icon) === false) {
			$icon = match ($status) {
				'info' => 'symbols.info-circle',
				'success' => 'symbols.check-circle',
				'warning' => 'symbols.alert-triangle',
				'danger' => 'symbols.alert-octagon',
				default => null,
			};
		}
    }
@endphp

<notice {{ $attributes }}>
	@isset($icon)
		{!! icon($icon) !!}
	@endisset
	<content>{{ $slot }}</content>
</notice>