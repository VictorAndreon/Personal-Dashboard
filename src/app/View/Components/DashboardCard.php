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

    /**
     * Direção matemática (independente de tipo)
     */
    private function calculateDirection(): string
    {
        if (!$this->variation) {
            return 'stable';
        }
        
        $percentage = $this->variation['percentage'] ?? 0;
        
        return match(true) {
            $percentage > 0 => 'up',
            $percentage < 0 => 'down',
            default => 'stable'
        };
    }

    /**
     * Sentimento de negócio (depende de tipo)
     */
    private function calculateSentiment(): string
    {
        if (!$this->variation) {
            return 'neutral';
        }
        
        $percentage = $this->variation['percentage'] ?? 0;
        $type = $this->variation['type'] ?? null;
        
        if ($type === null) {
            return match(true) {
                $percentage > 0 => 'positive',
                $percentage < 0 => 'negative',
                default => 'neutral'
            };
        }
        
        // Com tipo = lógica de negócio
        return match(true) {
            ($percentage > 0 && $type === 'income') => 'positive',  // Income subiu = bom
            ($percentage < 0 && $type === 'expense') => 'positive', // Expense caiu = bom
            ($percentage > 0 && $type === 'expense') => 'negative', // Expense subiu = ruim
            ($percentage < 0 && $type === 'income') => 'negative',  // Income caiu = ruim
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