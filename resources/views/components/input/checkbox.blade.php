@aware(['type' => 'checkbox', 'name' => null, 'default' => null])
@props(['title', 'value' => '1'])

<label {{ $attributes->class(['input-choice', 'masked'])->only(['class'])->merge(['aria-label' => __($title)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name, 'value' => $value])->except('class') }} @checked(old($name, $default) === $value)>
	<indicator></indicator>
	<content>
		{{ __($title) }}
	</content>
</label>