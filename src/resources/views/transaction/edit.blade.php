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
                    Atualizar Movimentação
                </h2>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-stone-100 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <x-input-label for="description" value="Descrição" />
                        <x-text-input 
                            id="description" 
                            name="description" 
                            type="text" 
                            class="mt-1 block w-full text-black" 
                            value='{{$transaction->description}}' required autofocus 
                        />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
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
                        <x-input-label for="amount" value="Valor (R$)" />
                        <x-text-input 
                            id="amount" 
                            name="amount" 
                            type="number" 
                            step="0.01" 
                            class="mt-1 block w-full" 
                            value='{{$transaction->amount}}' required 
                        />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="transaction_date" value="Data" />
                        <x-text-input 
                            id="transaction_date" 
                            name="transaction_date" 
                            type="date" 
                            class="datepicker form-input mt-1 block w-full" 
                            value="{{$transaction->transaction_date}}" required 
                        />
                    </div>

                    <div>
                        <x-input-label for='type' value="Tipo de Movimentação"/>
                        <select name='type'>
                            <option value='income'>Entrada</option>
                            <option value='expense'>Saída</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for='category' value="Categoria"/>
                        <select name="category" required class="w-full border rounded px-3 py-2">
                            <option value="">Selecione uma categoria</option>

                            <optgroup label="💸 Despesas">
                                <option value="housing">🏠 Moradia</option>
                                <option value="food">🍔 Alimentação</option>
                                <option value="transportation">🚗 Transporte</option>
                                <option value="entertainment">🎮 Lazer</option>
                                <option value="health">💊 Saúde</option>
                                <option value="education">📚 Educação</option>
                                <option value="shopping">🛒 Compras</option>
                                <option value="bills">📄 Contas</option>
                                <option value="others">📦 Outros</option>
                            </optgroup>

                            <optgroup label="💰 Receitas">
                                <option value="salary">💵 Salário</option>
                                <option value="freelance">💼 Freelance</option>
                                <option value="investment">📈 Investimento</option>
                                <option value="gift">🎁 Presente</option>
                                <option value="refund">🔄 Reembolso</option>
                                <option value="other_income">💸 Outras Receitas</option>
                            </optgroup>
                        </select>
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
