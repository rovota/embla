@aware(['type' => 'checkbox', 'name' => null, 'default' => null])
@props(['label', 'description', 'value' => '1'])

<label {{ $attributes->class(['input-toggle', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name, 'value' => $value])->except('class') }} @checked(old($name, $default) === $value)>
	<content>
		<span>{{ __($label) }}</span>
		@isset($description)
			<p>{{ __($description) }}</p>
		@endisset
	</content>
	<toggle></toggle>
</label>