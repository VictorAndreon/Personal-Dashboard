@props([
    'value',
    'variation',
    'category'
])

<div class="p-4 rounded-lg shadow bg-white w-1/5 text-center"> 
    <div class="text-xl text-gray-600">
        {{ $title }}
    </div>
    <div class="flex items-center justify-center pt-2">
        <span class="font-bold text-lg {{ $value > 0 ? 'text-green-500' : ($value == 0 ? 'text-gray-500' : 'text-red-500') }}">
            {{ format_currency($value) }}
        </span>
    </div>
    @if(isset($variation))
        @php
            $color = $variation['percentage'] > 0 ? 'text-green-500' : ($variation['percentage'] < 0 ? 'text-red-500' : 'text-gray-500');
        @endphp 
        <div class="flex justify-center items-center gap-1 text-sm">
            @if($variation['trend'] === 'up')
                <span class="font-semibold"><i class="fa-solid fa-arrow-trend-up {{$color}}"></i></span>
            @elseif($variation['trend'] === 'neutral')
                <span class="font-semibold"><i class="fa-solid fa-minus {{$color}}" ></i></span>
            @else
                <span class="font-semibold"><i class="fa-solid fa-arrow-trend-down {{$color}}"></i></span>
            @endif
            <span class="font-medium">
                {{ abs(round($variation['percentage'])) }}%
            </span>
            <span class="text-gray-600 dark:text-gray-600">
                vs mês anterior
            </span>
        </div>
    @else
        <div class="flex justify-center items-center gap-1 text-sm">
            <span class="text-gray-600">{{$category}}</span>
        </div>
    @endif
</div>