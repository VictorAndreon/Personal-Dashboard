<div class="p-4 rounded-lg shadow {{ $color }}"> <div class="flex items-center justify-between">
        <span class="text-2xl">{{ $icon }}</span>
        
        <span class="font-bold text-lg">
            {{ $formattedAmount() }}
        </span>
    </div>
    
    <div class="text-sm opacity-75">
        {{ $title }}
    </div>
</div>