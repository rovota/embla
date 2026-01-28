@props(['size' => 'flexible', 'style' => 'interaction-only', 'language' => app()->getLocale()])

<div {{ $attributes->class(['cf-turnstile'])->merge([
	'data-size' => $size,
	'data-appearance' => $style,
	'data-language' => $language,
	'data-sitekey' => config('services.turnstile.public_key')
	]) }}>
</div>