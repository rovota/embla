@php use Rovota\Embla\Data\Colors\Status; @endphp
@props(['dynamic' => null])
@aware(['label'])

@php
	if (isset($dynamic) && $attributes->has(['value', 'max'])) {
		$intervals = [
			0 => Status::Success,
			60 => Status::Warning,
			90 => Status::Danger,
		];

		$percentage = (100 / $attributes->get('max') * $attributes->get('value'));

		foreach ($intervals as $interval => $status) {
			if ((int) $percentage >= $interval) {
				$attributes = $attributes->class('accent-' . $status->value);
			}
		}
	}
@endphp

<progress @isset($label)aria-label="{{ __($label) }}"@endisset {{ $attributes }}></progress>