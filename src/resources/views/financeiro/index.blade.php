<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $tipo_movimentacao === 'entrada' ? 'Entradas 💰' : 'Saídas 💸' }}
            </h2>
            <a href="{{ route('financeiro.create', ['tipo_movimentacao' => $tipo_movimentacao]) }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                Nova {{ $tipo_movimentacao === 'entrada' ? 'Entrada' : 'Saída' }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($movimentacao->isEmpty())
                        <p class="text-gray-500 text-center">Nenhum registro encontrado.</p>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-500 border-b">
                                    <th class="p-3">Data</th>
                                    <th class="p-3">Descrição</th>
                                    <th class="p-3">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimentacaos as $movimentacao)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="p-3">{{ $movimentacao->dt_transacao->format('d/m/Y') }}</td>
                                        <td class="p-3">{{ $movimentacao->descricao }}</td>
                                        <td class="p-3 font-bold {{ $movimentacao->tipo_movimentacao == 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                                            R$ {{ number_format($movimentacao->qtd_valor, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="mt-4">
                            {{ $movimentacaos->appends(['tipo_movimentacao' => $tipo_movimentacao])->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>