<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Categorias
        View::composer(['transaction.*', 'dashboard'], function ($view){
            $categories = [
                'Despesas' => [
                    'housing'        => '🏠 Moradia',
                    'food'           => '🍔 Alimentação',
                    'transportation' => '🚗 Transporte',
                    'entertainment'  => '🎮 Lazer',
                    'health'         => '💊 Saúde',
                    'education'      => '📚 Educação',
                    'shopping'       => '🛒 Compras',
                    'bills'          => '📄 Contas',
                    'others'         => '📦 Outros',
                ],
                'Receitas' => [
                    'salary'       => '💵 Salário',
                    'freelance'    => '💼 Freelance',
                    'investment'   => '📈 Investimento',
                    'gift'         => '🎁 Presente',
                    'refund'       => '🔄 Reembolso',
                    'other_income' => '💸 Outras Receitas',
                ]
            ];

            $view->with('categories', $categories);
        });
    }
}

