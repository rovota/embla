@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['label', 'value' => '1'])

<label {{ $attributes->class(['input-choice', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<indicator></indicator>
	<content>
		{{ __($label) }}
	</content>
</label>