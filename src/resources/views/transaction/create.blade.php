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
                    Adicionar Transação
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-white shadow-sm sm:rounded-lg p-6" >
                
                <form action="{{ route('transaction.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <x-form.input-label for="description" value="Descrição" />
                        <x-form.input-text id="description" name="description" type="text" class="mt-1 block w-full text-[#E0E0E0]" required autofocus />
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
                        <x-form.input-text id="amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" required />
                        <x-form.input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for="transaction_date" value="Data" />
                        <x-form.input-text id="transaction_date" name="transaction_date" type="date" class="datepicker form-input mt-1 block w-full" value="{{now()->format('Y-m-d')}}" required />
                        <x-form.input-error :messages="$errors->get('transaction_date')" class="mt-2" />
                    </div>

                    <div>
                        <x-form.input-label for='type' value="Tipo de Movimentação"/>
                        <div class="join w-full">
                            <input type="radio" name="type" value="income" id="opt_income" class="peer/income hidden" 
                                @checked(old('type', $transaction->type ?? '') == 'income') />
                            
                            <label for="opt_income" 
                                class="join-item btn w-1/2 bg-gray-900 shadow-none border border-gray-700 text-[#E0E0E0] rounded-md hover:text-black hover:bg-primary-50 peer-checked/income:bg-primary-600 peer-checked/income:text-white peer-checked/income:border-primary-600">
                                Receita
                            </label>

                            <input type="radio" name="type" value="expense" id="opt_expense" class="peer/expense hidden" 
                                @checked(old('type', $transaction->type ?? '') == 'expense') />
                            
                            <label for="opt_expense" 
                                class="join-item btn w-1/2 bg-gray-900 shadow-none border border-gray-700 text-[#E0E0E0] rounded-md hover:text-black hover:bg-primary-50 peer-checked/expense:bg-primary-600 peer-checked/expense:text-white peer-checked/expense:border-primary-600">
                                Despesa
                            </label>
                        </div>
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
                            Salvar
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>