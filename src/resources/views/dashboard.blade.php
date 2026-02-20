<x-app-layout>
{{-- @php
dd($categories['Despesas'][$monthlySummary["mostExpensiveCategory"]["category"]]);
@endphp --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-2 justify-center bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <x-dashboard-card :value='$monthlySummary["todayBalance"]["value"]' :variation='$monthlySummary["todayBalance"]["variation"]'>
                    <x-slot name='title'>Saldo Atual</x-slot>
                </x-dashboard-card>
                <x-dashboard-card :value='$monthlySummary["monthlyIncome"]["value"]' :variation='$monthlySummary["monthlyIncome"]["variation"]'>
                    <x-slot name='title'>Receitas do Mês</x-slot>
                </x-dashboard-card>
                <x-dashboard-card :value='$monthlySummary["monthlyExpense"]["value"]' :variation='$monthlySummary["monthlyExpense"]["variation"]'>
                    <x-slot name='title'>Despesas do Mês</x-slot>
                </x-dashboard-card>
                <x-dashboard-card :value='$monthlySummary["mostExpensiveCategory"]["value"]' :category='$categories["Despesas"][$monthlySummary["mostExpensiveCategory"]["category"]]'>
                    <x-slot name='title'>Categoria mais gasta do Mês</x-slot>
                </x-dashboard-card>
            </div>
        </div>
    </div>
</x-app-layout>
