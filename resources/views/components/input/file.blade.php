@props(['missing' => 'Select file(s)', 'selected' => '%1$s files selected', ''])
@aware(['name' => null])

<input type="file" {{ $attributes->merge([
	'id' => $name,
	'name' => $name,
	'data-missingcaption' => $missing,
	'data-selectedcaption' => $selected,
]) }}>

<label for="{{ $name }}"></label>