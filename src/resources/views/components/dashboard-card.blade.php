<div class="p-4 rounded-lg shadow bg-white w-1/5 text-center"> 
    <div class="text-xl text-gray-600">
        {{ $title }}
    </div>
    
    <div class="flex items-center justify-center pt-2">
        <span class="font-bold text-lg {{ $value > 0 ? 'text-green-500' : ($value < 0 ? 'text-red-500' : 'text-gray-500') }}">
            {{ format_currency($value) }}
        </span>
    </div>

    @if($variation)
        <div class="flex justify-center items-center gap-1 text-sm">
            <span class="font-semibold {{ $color }}">
                <i class="fa-solid {{ $icon }}"></i>
            </span>
            <span class="font-medium">
                {{ abs(round($variation['percentage'])) }}%
            </span>
            <span class="text-gray-600">vs mês anterior</span>
        </div>
    @elseif($category)
        <div class="flex justify-center items-center gap-1 text-sm">
            <span class="text-gray-600">{{ $category }}</span>
        </div>
    @endif
</div>