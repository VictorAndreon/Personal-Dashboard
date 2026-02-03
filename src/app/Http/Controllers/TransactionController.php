<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd($request->all());
        $validated = $request->validate([
            'description'      => 'required|string|max:255',
            'amount'           => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'type'             => 'required|in:income, expense',
            'category'         => 'required',
        ]);
        
        // Adiciona o ID do usuário automaticamente
        $validated['user_id'] = Auth::id();
        Transaction::create($validated);

        return redirect()->route('transaction.index');
    }

    public function destroy($idTransacao)
    {
        $transaction = Transaction::findOrFail($idTransacao);
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
