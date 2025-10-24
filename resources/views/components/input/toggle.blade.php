@aware(['type' => 'checkbox', 'name' => null, 'default' => null, 'fallback' => 'on'])
@props(['label', 'description', 'value' => '1'])

<label {{ $attributes->class(['input-toggle', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	@if($fallback === 'on')
		<input type="hidden" name="{{ $name }}" value="0">
	@endif
	<input type="{{ $type }}" {{ $attributes->merge(['id' => $value, 'name' => $name, 'value' => $value])->except('class') }} @checked(old($name, $default) === $value)>
	<content>
		<span>{{ __($label) }}</span>
		@isset($description)
			<p>{{ __($description) }}</p>
		@endisset
	</content>
	<toggle></toggle>
</label>