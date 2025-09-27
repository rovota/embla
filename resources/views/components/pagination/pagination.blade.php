@props(['pages', 'current' => request()->get('page', 1)])

@if((int) $pages > 0)
	<pagination>
		@if($current > 1)
			<x-anchor href="{{ request()->fullUrlWithQuery(['page' => $current - 1]) }}" class="icon">{!! icon('arrows.chevron-left') !!}</x-anchor>
		@endif

		@foreach(array_fill(1, $pages, 0) as $number => $value)
			<x-anchor href="{{ request()->fullUrlWithQuery(['page' => $number]) }}" @class(['active' => $number === (int)$current])>{{ $number }}</x-anchor>
		@endforeach

		@if($current < $pages)
			<x-anchor href="{{ request()->fullUrlWithQuery(['page' => $current + 1]) }}" class="icon">{!! icon('arrows.chevron-right') !!}</x-anchor>
		@endif
	</pagination>
@endif