@aware(['type' => 'checkbox', 'name' => null, 'default' => null, 'fallback' => 'on'])
@props(['label', 'value' => '1'])

<label {{ $attributes->class(['input-choice', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	@if($fallback === 'on')
		<input type="hidden" name="{{ $name }}" value="0">
	@endif
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name, 'value' => $value])->except('class') }} @checked(old($name, $default) === $value)>
	<indicator></indicator>
	<content>
		{{ __($label) }}
	</content>
</label>