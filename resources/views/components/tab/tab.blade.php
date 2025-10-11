@props(['name' => null])

<x-embla::anchor {{ $attributes->class(['tab-' . ($name ?? 'unknown')]) }}>{{ $slot }}</x-embla::anchor>