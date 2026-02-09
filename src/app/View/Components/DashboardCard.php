<?php

namespace App\View\Components;

use App\Models\Transaction;
use App\Services\FinancialService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $value;
    public $title;
    public $color;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($value)
    {
        $this->value = $value;

    }

    public function formattedAmount()
    {
        return 'R$ ' . number_format($this->value, 2, ',', '.');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
