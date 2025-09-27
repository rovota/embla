@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['label'])

<label {{ $attributes->class(['input-swatch', 'masked', 'accent-'.$attributes->get('value')])->only(['class'])->merge(['title' => __($label)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<checkmark></checkmark>
</label>