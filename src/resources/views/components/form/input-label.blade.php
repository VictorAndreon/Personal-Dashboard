@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-gray-700 dark:text-[#E0E0E0] font-medium']) }}>
    {{ $value ?? $slot }}
</label>
