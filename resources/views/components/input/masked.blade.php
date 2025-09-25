@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['title'])

<label {{ $attributes->class(['masked'])->only(['class'])->merge(['aria-label' => __($title)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<indicator></indicator>
	<content>
		{{ $slot }}
	</content>
</label>