<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public string $title;
    public float $value;
    public ?array $variation;
    public ?string $category;
    
    public string $direction;
    public string $sentiment; 
    public string $color;
    public string $icon;

    public function __construct(
        string $title,
        float $value,
        ?array $variation = null,
        ?string $category = null
    ) {
        $this->title = $title;
        $this->value = $value;
        $this->variation = $variation;
        $this->category = $category;
        
        $this->direction = $this->calculateDirection();
        $this->sentiment = $this->calculateSentiment();
        $this->color = $this->getColorClass();
        $this->icon = $this->getIconClass();
    }

    private function calculateDirection(): string
    {
        if (!$this->variation) {
            return 'stable';
        }

        // Confia no trend calculado pela service
        return match($this->variation['trend'] ?? 'neutral') {
            'up'   => 'up',
            'down' => 'down',
            default => 'stable'
        };
    }

    private function calculateSentiment(): string
    {
        if (!$this->variation) {
            return 'neutral';
        }

        $trend = $this->variation['trend'] ?? 'neutral';
        $type  = $this->variation['type'] ?? null;

        if ($type === null) {
            return match($trend) {
                'up'   => 'positive',
                'down' => 'negative',
                default => 'neutral'
            };
        }

        return match(true) {
            ($trend === 'up'   && $type === 'income')  => 'positive',
            ($trend === 'down' && $type === 'expense') => 'positive',
            ($trend === 'up'   && $type === 'expense') => 'negative',
            ($trend === 'down' && $type === 'income')  => 'negative',
            default => 'neutral'
        };
    }

    private function getColorClass(): string
    {
        return match($this->sentiment) {
            'positive' => 'text-green-500',
            'negative' => 'text-red-500',
            default => 'text-gray-500'
        };
    }

    private function getIconClass(): string
    {
        return match($this->direction) {
            'up' => 'fa-arrow-trend-up',
            'down' => 'fa-arrow-trend-down',
            default => 'fa-minus'
        };
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}