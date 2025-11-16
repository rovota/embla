@props(['has' => null, 'label' => null, 'default' => null])

<input-group {{ $attributes }}>
	@if(isset($has) && isset($label))
		<x-embla::input.label for="{{ $has }}">{{ $label }}</x-embla::input.label>
	@endisset

	{{ $slot }}

	@isset($has)
		<x-embla::input.errors :field="$has" />
	@endisset
</input-group>