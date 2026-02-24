<x-app-layout>
@php
    $category = $categories["Despesas"][$monthlySummary["topCategory"]["category"]] ?? 'Sem Registros';
@endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-2 justify-center bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-dashboard-card :value='$monthlySummary["todayBalance"]["value"]' :variation='$monthlySummary["todayBalance"]["variation"]' title='Saldo Atual'/>
                <x-dashboard-card :value='$monthlySummary["monthlyIncome"]["value"]' :variation='$monthlySummary["monthlyIncome"]["variation"]' title='Receitas do Mês'/>
                <x-dashboard-card :value='$monthlySummary["monthlyExpense"]["value"]' :variation='$monthlySummary["monthlyExpense"]["variation"]' title='Despesas do Mês'/>
                <x-dashboard-card :value='$monthlySummary["topCategory"]["value"]' :category='$category' title='Categoria mais gasta do Mês'/>
            </div>
        </div>
    </div>
</x-app-layout>
