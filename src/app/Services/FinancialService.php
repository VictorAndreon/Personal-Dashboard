<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class FinancialService
{
    public function getBalance (int $userId)
    {
        return Cache::remember(
            key: "user_balance_{$userId}",
            ttl: 300, 
            callback: function () use ($userId) {
                return Transaction::User($userId)
                    ->selectRaw('
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) -
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) as value
                    ', ['income', 'expense'])
                    ->value('value') ?? 0;
            }
        );
    }

    public function getMonthBalance(int $userId)
    {
        $resultado = Transaction::query()
                        ->User($userId)
                        ->CurrentMonth()
                        ->selectRaw('
                            SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS receita,
                            SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS despesa
                        ',['income', 'expense'])
                        ->first();
        $receita = floatval($resultado->receita ?? 0);
        $despesa = floatval($resultado->despesa ?? 0);

        return $receita - $despesa;
    }
}
