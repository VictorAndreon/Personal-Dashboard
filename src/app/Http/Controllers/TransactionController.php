<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Busca no banco só o que é do usuário logado E do tipo selecionado
        $transactions = Transaction::where('user_id', Auth::id())
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view('transaction.index', compact('transactions'));
    }

    // Mostra o formulário de criar
    public function create()
    {
        return view('transaction.create');
    }

    // Salva no banco
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description'      => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'type'             => 'required|in:income,expense',
            'category'         => 'required',
        ]);
        
        // Adiciona o ID do usuário automaticamente
        $validated['user_id'] = Auth::id();
        Transaction::create($validated);

        return redirect()->route('transaction.index')->with('success', 'Transação adicionada com sucesso!');
    }

    public function edit($idTransaction)
    {
        $transaction = Transaction::where('user_id', Auth::id())
                        ->where('id', $idTransaction)
                        ->firstOrFail();

        return view('transaction.edit')
        ->with('transaction', $transaction);
    }

    public function update(Transaction $transaction, Request $request)
    {
         Gate::authorize('update', $transaction);

        $validated = $request->validate([
            'description'      => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'type'             => 'required|in:income,expense',
            'category'         => 'required',
        ]);

        $transaction->update($validated);

        return redirect()->route('transaction.index')->with('success', 'Transação atualizada com sucesso!');
    }

    public function destroy($idTransaction)
    {
        $transaction = Transaction::findOrFail($idTransaction);
        try{
            $transaction->delete();

            return redirect()->route('transaction.index')
                 ->with('success', 'Registro deletado!');
        }catch(\Exception $ex){
            return redirect()->route('transaction.index')
                 ->with('error', 'Houve um erro ao deletar o registro!');
        }
    }
}
