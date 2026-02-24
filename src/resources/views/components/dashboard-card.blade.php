<div class="p-4 rounded-lg shadow bg-gray-800 w-full text-center"> 
    <div class="text-xl text-white">
        {{ $title }}
    </div>
    
    <div class="flex items-center justify-center pt-2">
        @if($variation)
            <span class="font-bold text-2xl p-2 {{ $value > 0 ? 'text-green-500' : ($value < 0 ? 'text-red-500' : 'text-gray-500') }}">
                {{ format_currency($value) }}
            </span>
        @elseif($category)
            <span class="font-bold text-2xl p-2 text-red-500">
                {{ format_currency($value) }}
            </span>
        @endif
    </div>

    @if($variation)
        <div class="flex justify-center items-center gap-1 text-sm">
            <span class="font-semibold {{ $color }}">
                <i class="fa-solid {{ $icon }}"></i>
            </span>
            <span class="font-medium {{ $color }}">
                {{ abs($variation['percentage']) }}%
            </span>
            <span class="text-white">vs mês anterior</span>
        </div>
    @elseif($category)
        <div class="flex justify-center items-center gap-1 text-sm">
            <span class="text-white">{{ $category }}</span>
        </div>
    @endif
</div>