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
                return [
                    'todayBalance' => [
                        'value' => $this->getTodayBalance($userId),
                        'variation' => $this->getTodayVariation($userId)
                        ],
                    'monthlyIncome' => [
                        'value' => $this->getMonthBalance($userId)['income'],
                        'variation' => $this->getMonthVariation($userId, 'income'),
                    ],
                    'monthlyExpense' => [
                        'value' => $this->getMonthBalance($userId)['expense'],
                        'variation' => $this->getMonthVariation($userId, 'expense'),
                    ],
                    'mostExpensiveCategory' => [
                        'category'  => $this->getMostExpensiveCategoryMonth($userId)['category'],
                        'value'     => $this->getMostExpensiveCategoryMonth($userId)['value'],
                    ]
                ];
            }
        );
    }

    //Saldo Atual => Entradas - Saídas
    public function getTodayBalance(int $userId)
    {
        $result = Transaction::User($userId)
                    ->selectRaw('
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) as total_income,
                        SUM(CASE WHEN type = ? THEN amount ELSE 0 END) as total_expense
                    ', ['income', 'expense'])
                    ->first();

        $income = (float)($result->total_income ?? 0);
        $expense = (float)($result->total_expense ?? 0);
        return $income - $expense;
    }

    public function getTodayVariation (int $userId)
    {
        $lastMonth = $this->getLastMonthBalance($userId)['result'];
        $currentMonth = $this->getTodayBalance($userId);

        if($lastMonth == 0){
            return ['percentage' => 0, 'trend' => 'neutral'];
        }

        $percentage = ($currentMonth - $lastMonth) / $lastMonth * 100;

        $result = [
            'percentage' => $percentage,
            'trend'      => $percentage > 0 ? 'up' : ( $percentage < 0 ? 'down' : 'neutral'),
        ];

        return $result;
    }

    //Saldo Mensal de Entradas e Saídas
    public function getMonthBalance(int $userId)
    {
        $result = $this->getBalanceByScope($userId, 'CurrentMonth');

        $values = [
            'income'  => (float)$result->income,
            'expense' => (float)$result->expense * (-1),
        ];

        return $values;
    }

    public function getMonthVariation (int $userId, string $type) 
    {
        $currentMonthIncome  = $this->getMonthBalance($userId)['income'];
        $currentMonthExpense = $this->getMonthBalance($userId)['expense'];

        $lastMonthIncome  = $this->getLastMonthBalance($userId)['income'];
        $lastMonthExpense = $this->getLastMonthBalance($userId)['expense'];

        if ($lastMonthIncome == 0 && $type === 'income'){
            return ['percentage' => 0, 'trend' => 'neutral'];

        }elseif ($lastMonthExpense == 0 && $type === 'expense'){
            return ['percentage' => 0, 'trend' => 'neutral'];
        }

        if($type === 'income'){
            $percentage = ($currentMonthIncome - $lastMonthIncome) / $lastMonthIncome * 100;

        }else{
            $percentage = ($currentMonthExpense - $lastMonthExpense) / $lastMonthExpense * 100 * -1;
        }

        $values = [
            'percentage' => $percentage,
            'trend'      => $type === 'income' ? ($percentage > 0 ? 'up' : ( $percentage < 0 ? 'down' : 'neutral')) : ($percentage < 0 ? 'up' : ( $percentage > 0 ? 'down' : 'neutral')),
        ];

        return $values; 
    }


    public function getLastMonthBalance(int $userId)
    {
        $result = $this->getBalanceByScope($userId, 'LastMonth');

        $values = [
            'result'  => (float)($result->income - $result->expense),
            'income'  => (float)$result->income,
            'expense' => (float)$result->expense * (-1),
        ];

        return $values;
    }

    //Categoria mais gasta
    public function getMostExpensiveCategoryMonth (int $userId)
    {
        $query = Transaction::User($userId)
                    ->CurrentMonth()
                    ->where('type', 'expense')
                    ->selectRaw('
                        category, 
                        count(*) as total,
                        SUM(amount) as total_value')
                    ->groupBy('category')
                    ->orderBy('total', 'desc')
                    ->first();
                    
        $values = [
            'value' => $query->total_value ?? 0,
            'category' => $query->category ?? 'Sem Registros',
        ];

        return $values;
    }

    public function getBalanceByScope (int $userId, string $scope)
    {
        return Transaction::query()
                ->User($userId)
                ->{$scope}()
                ->selectRaw('
                    SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS income,
                    SUM (CASE WHEN type = ? THEN amount ELSE 0 END) AS expense
                ',['income', 'expense'])
                ->first();
    }
}
