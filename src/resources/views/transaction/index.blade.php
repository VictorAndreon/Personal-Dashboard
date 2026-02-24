<x-app-layout>
    <x-slot name="header">
        @if(!$transactions->isEmpty())
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-200">
                    Transações
                </h2>
                <a href="{{ route('transaction.create') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                    Adicionar Transação
                </a>
            </div>
        @endif
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    @if($transactions->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-gray-100">
                                Nenhuma transação ainda
                            </h3>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Comece adicionando sua primeira movimentação financeira.
                            </p>
                            <a href="{{ route('transaction.create') }}" 
                               class="mt-6 inline-block bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">
                                Adicionar Primeira Transação
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Data</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Descrição</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Categoria</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Valor</th>
                                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Ações</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($transactions as $transaction)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="px-4 py-3 text-base text-gray-900 dark:text-gray-100">
                                                {{ $transaction->transaction_date->format('d/m/Y') }}
                                            </td>
                                            <td class="px-4 py-3 text-base text-gray-900 dark:text-gray-100">
                                                {{ $transaction->description }}
                                            </td>
                                            <td class="px-4 py-3 text-base text-gray-100 text-right">
                                                {{ $categories[$transaction->type === 'income' ? 'Receitas' : 'Despesas'][$transaction->category] }}
                                            </td>
                                            <td class="px-4 py-3 text-base font-semibold text-right {{ $transaction->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $transaction->type == 'income' 
                                                    ? format_currency($transaction->amount,'BRL','+') 
                                                    : format_currency($transaction->amount,'BRL','-') }}
                                            </td>
                                            <td class="px-4 py-3 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('transaction.edit', $transaction) }}" 
                                                       class="text-primary-600 hover:text-primary-700 transition">
                                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16">
                                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                        </svg>
                                                    </a>
                                                    <form method="POST" 
                                                          action="{{ route('transaction.destroy', $transaction) }}" 
                                                          onsubmit="confirmaExclusao(event)">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-primary-600 hover:text-primary-700 transition">
                                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
