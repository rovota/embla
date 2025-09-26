@props(['name'])

<x-embla::anchor {{ $attributes->class(['tab-' . $name]) }}>{{ $slot }}</x-embla::anchor>