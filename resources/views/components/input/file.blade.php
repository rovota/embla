@aware(['name' => null, 'missing' => 'Select file(s)', 'selected' => '%1$s selected'])

<input type="file" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'data-missingcaption' => __($missing),
	'data-selectedcaption' => __($selected),
]) }}>

<label for="{{ $name }}"></label>