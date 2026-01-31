<?php

namespace App\Http\Controllers;

use App\Models\Movimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimentacaoController extends Controller
{
    public function index(Request $request)
    {
        // Pega o tipo da URL (?tipo_movimentacao=entrada ou ?tipo_movimentacao=saida)
        $tipo_movimentacao = $request->query('tipo_movimentacao', 'entrada'); 
        
        // Busca no banco só o que é do usuário logado E do tipo selecionado
        $movimentacoes = Movimentacao::where('user_id', Auth::id())
            ->orderBy('dt_transacao', 'desc')
            ->get();

        return view('movimentacao.index', compact('movimentacoes'));
    }

    // Mostra o formulário de criar
    public function create(Request $request)
    {
        $tipo_movimentacao = $request->query('tipo_movimentacao', 'entrada');
        return view('movimentacao.create', compact('tipo_movimentacao'));
    }

    // Salva no banco
    public function store(Request $request)
    {
        $validated = $request->validate([
            'descricao' => 'required|string|max:255',
            'qtd_valor' => 'required|numeric|min:0.01',
            'dt_transacao' => 'required|date',
        ]);
        
        // Adiciona o ID do usuário automaticamente
        $validated['user_id'] = Auth::id();

        Movimentacao::create($validated);


        return redirect()->route('movimentacao.index', ['tipo_movimentacao' => $request->tipo_movimentacao]);
    }

    public function destroy($idTransacao)
    {
        $movimentacao = Movimentacao::findOrFail($idTransacao);
        $tipo_movimentacao = $movimentacao->tipo_movimentacao;

        try{
            $movimentacao->delete();

            return redirect()->route('movimentacao.index', ['tipo_movimentacao' => $tipo_movimentacao])
                 ->with('success', 'Registro deletado!');
        }catch(\Exception $ex){
            return redirect()->route('movimentacao.index', ['tipo_movimentacao' => $tipo_movimentacao])
                 ->with('error', 'Houve um erro ao deletar o registro!');
        }
    }
}
