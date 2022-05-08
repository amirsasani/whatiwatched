@props(['value'])

<label {{ $attributes->merge(['class' => 'block mt-4 text-sm']) }}>
    {{ $value ?? $slot }}
</label>
