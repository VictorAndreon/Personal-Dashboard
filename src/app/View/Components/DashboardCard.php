<?php

namespace App\View\Components;

use App\Models\Transaction;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $transaction;
    public $title;
    public $color;
    public $icon;

    /**
     * Create a new component instance.
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;


    }

    public function formattedAmount()
    {
        return 'R$ ' . number_format($this->transaction, 2, ',', '.');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-card');
    }
}
