<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Adicionar Movimentação
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-100 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('movimentacao.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="tipo_movimentacao" value="{{ $tipo_movimentacao }}">

                    <div>
                        <x-input-label for="descricao" value="Descrição" />
                        <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full text-black" required autofocus />
                        <x-input-error :messages="$errors->get('descricao')" class="mt-2" />
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        <x-input-label for="qtd_valor" value="Valor (R$)" />
                        <x-text-input id="qtd_valor" name="qtd_valor" type="number" step="0.01" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('qtd_valor')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dt_transacao" value="Data" />
                        <x-text-input id="dt_transacao" name="dt_transacao" type="dt_transacao" class="datepicker form-input mt-1 block w-full" value="{{now()->format('Y-m-d')}}" required />
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
<script>

</script>