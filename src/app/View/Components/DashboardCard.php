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
        return format_currency($this->value, 'BRL');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
