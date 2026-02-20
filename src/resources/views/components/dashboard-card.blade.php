@props([
    'value',
    'variation'
])

<div class="p-4 rounded-lg shadow bg-white w-1/5 text-center"> 
    <div class="text-xl text-gray-600">
        {{ $title }}
    </div>
    <div class="flex items-center justify-center pt-2">
        <span class="font-bold text-lg {{ $value > 0 ? 'text-green-500' : 'text-red-500' }}">
            {{ format_currency($value) }}
        </span>
    </div>
    @if(isset($variation))
        <div class="flex items-center gap-1 text-sm">
            <span class="font-semibold"><i class="fa-solid fa-arrow-trend-up text-green-500"></i></span>
            <i class="fa-solid fa-arrow-trend-up"></i>
            <span class="font-medium">
                {{ abs($variation['percentage']) }}%
            </span>
            <span class="text-gray-500 dark:text-gray-400">
                vs mês anterior
            </span>
        </div>
    @endif
</div>