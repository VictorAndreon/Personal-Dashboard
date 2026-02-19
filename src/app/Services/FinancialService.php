<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class FinancialService
{
    public function getDashboardCardSummary(int $userId)
    {
        return Cache::remember(
            key: "user_balance_{$userId}",
            ttl: 300, 
            callback: function () use ($userId) {
                return [
                    'todayBalance' => [
                        'value' => $this->getTodayBalance($userId),
                        'variation' => [null, null]
                        ],
                    'monthlyBalance' => [
                        'value' => $this->getMonthlyBalance($userId),
                        'variation' => ['percentage' => 12, 'trend' => 'up'],
                    ]
                ];
            }
        );
    }

    public function getTodayBalance(int $userId)
    {
        $result = Transaction::User($userId)
                    ->selectRaw('
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) -
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) as value
                    ', ['income', 'expense'])
                    ->value('value');

        $result = (float)$result;
        
        return $result;
    }

    public function getMonthlyBalance(int $userId)
    {
        $result = Transaction::query()
                        ->User($userId)
                        ->CurrentMonth()
                        ->selectRaw('
                            SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS receita,
                            SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS despesa
                        ',['income', 'expense'])
                        ->first();
        $receita = floatval($result->receita ?? 0);
        $despesa = floatval($result->despesa ?? 0);

        return $receita - $despesa;
    }

    public function getMostExpensiveCategoryMonth (int $userId)
    {
        $result = Transaction::User($userId)
                    ->CurrentMonth()
                    ->where('type', 'expense')
                    ->selectRaw('category, count(*) as total')
                    ->groupBy('category')
                    ->orderBy('total', 'desc')
                    ->pluck('total', 'category');

        return $result;

    }
}
