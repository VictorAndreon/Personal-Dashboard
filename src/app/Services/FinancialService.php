<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class FinancialService
{
    //Função principal para retornar os dados para os Cards e mantê-los sempre disponíveis.
    public function getDashboardCardSummary(int $userId)
    {
        return Cache::remember(
            key: "dashboard_summary_{$userId}",
            ttl: 300,
            callback: function () use ($userId) {
                $today          = $this->getBalanceByScope($userId);
                $untilLastMonth = $this->getBalanceByScope($userId, until: now()->subMonth()->endOfMonth());
                $currentMonth   = $this->getBalanceByScope($userId, scope: 'CurrentMonth');
                $lastMonth      = $this->getBalanceByScope($userId, scope: 'LastMonth');
                $topCategory    = $this->getTopExpenseCategory($userId);

                return [
                    'todayBalance' => [
                        'value'     => $today['balance'],
                        'variation' => $this->calculateVariation($today['balance'], $untilLastMonth['balance']),
                    ],
                    'monthlyIncome' => [
                        'value'     => $currentMonth['income'],
                        'variation' => $this->calculateVariation($currentMonth['income'], $lastMonth['income'], 'income'),
                    ],
                    'monthlyExpense' => [
                        'value'     => $currentMonth['expense'] * -1,
                        'variation' => $this->calculateVariation($currentMonth['expense'], $lastMonth['expense'], 'expense'),
                    ],
                    'topCategory' => $topCategory,
                ];
            }
        );
    }

    //Pegas as ultimas 5 transações para a Dash
    public function getRecentTransactions (int $userId)
    {
        return Transaction::User($userId)
                    ->orderBy('transaction_date', 'desc')
                    ->limit(5)
                    ->get();
    }

    //Categoria mais gasta
    public function getTopExpenseCategory (int $userId)
    {
        $query = Transaction::User($userId)
                    ->CurrentMonth()
                    ->where('type', 'expense')
                    ->selectRaw('
                        category, 
                        count(*) as total,
                        SUM(amount) as total_value')
                    ->groupBy('category')
                    ->orderBy('total_value', 'desc')
                    ->first();
                    
        $values = [
            'value' => $query->total_value ?? 0,
            'category' => $query->category ?? null,
        ];

        return $values;
    }

    //Calcular variação de PL
    private function calculateVariation(float $current, float $previous, ?string $type = null): array
    {
        if ($previous == 0) {
            return ['percentage' => 0, 'trend' => 'neutral', 'type' => $type];
        }

        $percentage = ($current - $previous) / abs($previous) * 100;

        // Corrige o trend quando ambos são negativos
        $trend = match(true) {
            $current < 0 && $previous < 0 && $current < $previous => 'down',
            $current < 0 && $previous < 0 && $current > $previous => 'up',
            $percentage > 0 => 'up',
            $percentage < 0 => 'down',
            default => 'neutral'
        };

        return [
            'percentage' => round(abs($percentage), 2),
            'trend'      => $trend,
            'type'       => $type,
        ];
    }

    //Função genérica para as consultas
    private function getBalanceByScope(int $userId, ?string $scope = null, ?\Carbon\Carbon $until = null): array
    {
        $query = Transaction::query()->User($userId);

        if ($scope !== null) {
            $query = $query->{$scope}();
        }

        if ($until !== null) {
            $query = $query->where('transaction_date', '<=', $until);
        }

        $result = $query->selectRaw('
            SUM(CASE WHEN type = ? THEN amount ELSE 0 END) AS income,
            SUM(CASE WHEN type = ? THEN amount ELSE 0 END) AS expense
        ', ['income', 'expense'])->first();

        return [
            'income'  => (float)($result->income ?? 0),
            'expense' => (float)($result->expense ?? 0),
            'balance' => (float)(($result->income ?? 0) - ($result->expense ?? 0)),
        ];
    }
}
