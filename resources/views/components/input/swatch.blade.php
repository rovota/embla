@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['title'])

<label {{ $attributes->class(['input-swatch', 'masked', 'accent-'.$attributes->get('value')])->only(['class'])->merge(['title' => __($title)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<checkmark></checkmark>
</label>