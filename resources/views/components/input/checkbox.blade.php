@aware(['type' => 'checkbox', 'name' => null, 'default' => null])
@props(['label', 'value' => '1'])

<label {{ $attributes->class(['input-choice', 'masked'])->only(['class'])->merge(['aria-label' => __($label)]) }}>
	<input type="hidden" name="{{ $name }}" value="0">
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name, 'value' => $value])->except('class') }} @checked(old($name, $default) === $value)>
	<indicator></indicator>
	<content>
		{{ __($label) }}
	</content>
</label>