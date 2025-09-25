@php use Illuminate\Support\Facades\Lang; @endphp

<select {{ $attributes->merge([
	'name' => 'language-switch',
	'title' => __('Change language'),
	'data-switch' => 'locale',
	'autocomplete' => 'off'
]) }}>
	@foreach(config('localization.locales') as $locale => $data)
		<option value="{{ $locale }}" @selected($locale === Lang::locale())>{{ $data['label']['native'] }}</option>
	@endforeach
</select>