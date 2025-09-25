@php use Illuminate\Support\Facades\Storage; @endphp
@aware(['type' => 'radio', 'name' => null, 'default' => null])
@props(['title'])

<label {{ $attributes->class(['input-theme', 'masked'])->only(['class'])->merge(['aria-label' => __($title)]) }}>
	<input type="{{ $type }}" {{ $attributes->merge(['name' => $name])->except('class') }} @checked(old($name, $default) === $attributes->get('value'))>
	<content>
		<img src="{!! Storage::url('interface/previews/' . $attributes->get('value') . '.svg') !!}" alt="{{ $title }}">
		<span>{{ __($title) }}</span>
	</content>
</label>