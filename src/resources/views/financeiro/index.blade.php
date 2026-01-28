<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ $tipo_movimentacao === 'entrada' ? 'Entradas 💰' : 'Saídas 💸' }}
            </h2>
            <a href="{{ route('financeiro.create', ['tipo_movimentacao' => $tipo_movimentacao]) }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                Nova {{ $tipo_movimentacao === 'entrada' ? 'Entrada' : 'Saída' }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($movimentacaos->isEmpty())
                        <p class="text-gray-500 text-center">Nenhum registro encontrado.</p>
                    @else
                        <table class="w-full border-collapse bg-gray-200">
                            <thead class="bg-gray-200 border-black border-b">
                                <tr class="text-center">
                                    <th class="p-3 text-left">Data</th>
                                    <th class="p-3">Descrição</th>
                                    <th class="p-3">Valor</th>
                                    <th class="p-3">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movimentacaos as $movimentacao)
                                    <tr class="border-b hover:bg-gray-300 odd:bg-gray-200 even:bg-white border-b border-black">
                                        <td class="p-3">{{ $movimentacao->dt_transacao->format('d/m/Y') }}</td>
                                        <td class="p-3 text-center">{{ $movimentacao->descricao }}</td>
                                        <td class="p-3 font-bold text-center {{ $movimentacao->tipo_movimentacao == 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                                            R$ {{ number_format($movimentacao->qtd_valor, 2, ',', '.') }}
                                        </td>
                                        <td class="p-3 text-center align-middle">
                                            <a href="#" onclick=teste() class="inline-flex items-center justify-center">
                                                <svg class="h-5 w-5 text-primary-600" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </a>   
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
