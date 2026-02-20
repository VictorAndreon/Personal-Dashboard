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
                    'moradia'      => '🏠 Moradia',
                    'alimentacao'  => '🍔 Alimentação',
                    'transporte'   => '🚗 Transporte',
                    'lazer'        => '🎮 Lazer',
                    'saude'        => '💊 Saúde',
                    'educacao'     => '📚 Educação',
                    'compras'      => '🛒 Compras',
                    'contas'       => '📄 Contas',
                    'outros'       => '📦 Outros',
                ],
                'Receitas' => [
                    'salario'         => '💵 Salário',
                    'freelance'       => '💼 Freelance',
                    'investimento'    => '📈 Investimento',
                    'presente'        => '🎁 Presente',
                    'reembolso'       => '🔄 Reembolso',
                    'outras_receitas' => '💸 Outras Receitas',
                ],
            ];

            $view->with('categories', $categories);
        });
    }
}

