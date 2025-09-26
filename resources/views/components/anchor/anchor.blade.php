@props(['message', 'target'])

@php
    if (isset($message)) {
		$attributes = $attributes->merge(['data-message' => $message]);
    }

	if (isset($target)) {
		if ($target === 'overlay') {
			$attributes = $attributes->merge(['data-overlay' => '']);
		} else {
			$attributes = $attributes->merge(['target' => '_' . $target]);
		}
    }
@endphp

<a {{ $attributes }}>{{ $slot }}</a>