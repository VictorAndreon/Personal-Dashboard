<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        Cache::forget("user_balance_{$transaction->user_id}");
    }

    public function updated(Transaction $transaction): void
    {
        Cache::forget("user_balance_{$transaction->user_id}");
    }

    public function deleted(Transaction $transaction): void
    {
        Cache::forget("user_balance_{$transaction->user_id}");
    }
}
