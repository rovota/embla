@aware(['type' => 'checkbox', 'name' => null, 'default' => null, 'fallback' => 'on'])
@props(['label', 'description', 'value' => '1'])

@php
	$defaults = old(trim($name, '[]'), str_contains($default, '|') ? explode('|', $default) : $default);
	if (is_array($defaults) === false) {
		$defaults = [$defaults];
	}

	if ($type === 'radio') {
		$fallback = 'off';
	}

	$checked = in_array($value, $defaults);
@endphp

<label {{ $attributes->class(['input-toggle', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	@if($fallback === 'on')
		<input type="hidden" name="{{ $name }}" value="0">
	@endif
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name, 'value' => $value])->except('class') }} @checked($checked)>
	<content>
		<span>{{ __($label) }}</span>
		@isset($description)
			<p>{{ __($description) }}</p>
		@endisset
	</content>
	<toggle></toggle>
</label>