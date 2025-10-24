@aware(['type' => 'checkbox', 'name' => null, 'default' => null, 'fallback' => 'on'])
@props(['label', 'value' => '1'])

@php
	$defaults = old($value, str_contains($default, '|') ? old($name, explode('|', $default)) : [$default]);
	$checked = in_array($value, $defaults);
@endphp

<label {{ $attributes->class(['input-choice', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	@if($fallback === 'on')
		<input type="hidden" name="{{ $name }}" value="0">
	@endif
	<input type="{{ $type }}" {{ $attributes->merge(['id' => $value, 'name' => $name, 'value' => $value])->except('class') }} @checked($checked)>
	<indicator></indicator>
	<content>
		{{ __($label) }}
	</content>
</label>