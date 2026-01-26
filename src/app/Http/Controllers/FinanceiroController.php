<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class FinanceiroController extends Controller
{
    public function index(Request $request)
    {
        // Pega o tipo da URL (?tipo_movimentacao=entrada ou ?tipo_movimentacao=saida)
        $tipo_movimentacao = $request->query('tipo_movimentacao', 'entrada'); 
        
        // Busca no banco só o que é do usuário logado E do tipo selecionado
        $movimentacaos = Movimentacao::where('user_id', Auth::id())
            ->where('tipo_movimentacao', $tipo_movimentacao)
            ->orderBy('dt_transacao', 'desc')
            ->get();

        return view('financeiro.index', compact('movimentacaos','tipo_movimentacao'));
    }

    // Mostra o formulário de criar
    public function create(Request $request)
    {
        $tipo_movimentacao = $request->query('tipo_movimentacao', 'entrada');
        return view('financeiro.create', compact('tipo_movimentacao'));
    }

    // Salva no banco
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'qtd_valor' => 'required|numeric|min:0.01',
            'dt_transacao' => 'required|date',
            'tipo_movimentacao' => 'required|in:entrada,saida',
        ]);

        // Adiciona o ID do usuário automaticamente
        $validated['user_id'] = Auth::id();


        Movimentacao::create($validated);
 
        return redirect()->route('financeiro.index', ['tipo_movimentacao' => $request->tipo_movimentacao])
            ->with('success', 'Transação criada com sucesso!');
    }

    public function destroy()
    {

    }
}
