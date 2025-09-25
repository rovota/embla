@aware(['name', 'default' => null])

<option {{ $attributes }} @selected(old($name, $default) === $attributes->get('value'))>{{ $slot }}</option>