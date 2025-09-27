@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['label', 'description'])

<label {{ $attributes->class(['input-panel', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<indicator></indicator>
	<content>
		<span>{{ __($label) }}</span>
		@isset($description)
			<p>{{ __($description) }}</p>
		@endisset
	</content>
</label>