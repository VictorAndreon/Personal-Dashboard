<x-app-layout>
{{-- @php
dd($monthlySummary["monthlyBalance"]["variation"]);
@endphp --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Você foi conectado!") }}
                    {{-- <p>Saldo Carteira: {{format_currency($balance, 'BRL')}}</p> --}}
                    {{-- <p>Saldo Mensal: {{format_currency($monthBalance)}}</p> --}}
                </div>
                <x-dashboard-card :value='$monthlySummary["monthlyBalance"]["value"]' :variation='$monthlySummary["monthlyBalance"]["variation"]'>
                    <x-slot name='title'>Receitas do Mês</x-slot>
                </x-dashboard-card>
            </div>
        </div>
    </div>
</x-app-layout>
