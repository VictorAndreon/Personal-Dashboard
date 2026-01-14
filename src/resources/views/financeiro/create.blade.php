<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar {{ $tipo_movimentacao === 'entrada' ? 'Entrada' : 'Saída' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('financeiro.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="tipo_movimentacao" value="{{ $tipo_movimentacao }}">

                    <div>
                        <x-input-label for="descricao" value="Descrição" />
                        <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full" required autofocus />
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="amount" value="Valor (R$)" />
                        <x-text-input id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="date" value="Data" />
                        <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" value="{{ date('Y-m-d') }}" required />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            Salvar
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>