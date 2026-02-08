@props([
    'name',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Selecione uma opção',
])

@php

    $hasOptgroup = !empty($options) && is_array(reset($options));
    $selectedValue = old($name, $selected);

@endphp

<select 
    name="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-md shadow-sm'
    ]) }}>

    @if($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @if($hasOptgroup)
        @foreach($options as $groupLabel => $groupOptions)
            <optgroup label="{{ $groupLabel }}">
                @foreach($groupOptions as $value => $label)
                    <option value="{{ $value }}" @selected($selectedValue == $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </optgroup>
        @endforeach
    @else
        @foreach($options as $value => $label)
            <option value="{{ $value }}" @selected($selectedValue == $value)>
                {{ $label }}
            </option>
        @endforeach
    @endif
</select>