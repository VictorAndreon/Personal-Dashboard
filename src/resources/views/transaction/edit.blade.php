<x-app-layout>
    <x-slot name="header">
        <div class='flex justify-between'>
            <div>
                <a href="{{ route('transaction.index') }}" class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700">
                    Voltar para listagem
                </a>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-white leading-tight">
                    Editar Transação
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-white shadow-sm sm:rounded-lg p-6" >
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-form.input-label for="description" value="Descrição" />
                        <x-form.input-text 
                            id="description" 
                            name="description" 
                            type="text" 
                            class="mt-1 block w-full text-black" 
                            value='{{$transaction->description}}' required autofocus 
                        />
                        <x-form.input-error :messages="$errors->get('description')" class="mt-2" />
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
                        <x-form.input-label for="amount" value="Valor (R$)" />
                        <x-form.input-text 
                            id="amount" 
                            name="amount" 
                            type="number" 
                            step="0.01" 
                            min="0.01"
                            class="mt-1 block w-full" 
                            value='{{$transaction->amount}}' required 
                        />
                        <x-form.input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for="transaction_date" value="Data" />
                        <x-form.input-text 
                            id="transaction_date" 
                            name="transaction_date" 
                            type="date" 
                            class="datepicker form-input mt-1 block w-full" 
                            value="{{$transaction->transaction_date}}" required 
                        />
                        <x-form.input-error :messages="$errors->get('transaction_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for="type" value="Tipo de Movimentação" />
                        <x-form.input-select 
                            name="type"
                            :options="[
                                'income' => 'Entrada',
                                'expense' => 'Saída'
                            ]"
                            :selected="$transaction->type ?? null"
                            required/>
                        <x-form.input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for='category' value="Categoria"/>
                        <x-form.input-select 
                            name='category'
                            :options="$categories"
                            placeholder='Selecione uma Categoria'
                            :selected="$transaction->category ?? null"
                            required/>
                        <x-form.input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            Atualizar
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
