<?php

namespace App\Http\Controllers;

use App\Receita;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReceitaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Busca categorias de um usuario especifico e do tipo receita
        $categorias = Categoria::where('user_id', Auth::user()->id)->where('receita', 0)->orWhere('receita', 2)->get();
        //Busca receitas de um usuario especifico
        $receitas = Receita::where('user_id', Auth::user()->id)->get();
        return view('dashboard/receitas', compact('categorias','receitas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->get('recorrente') == 1) {
            $validaMeses = 'required|integer';
        } else {
            $validaMeses = 'integer';
        }
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|between:0,99999999.99',
            'data_vencimento' => 'required|date',
            'descricao' => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            'forma_pagamento' => 'required|string|max:255',
            'disponivel' => 'required|boolean',
            'fixa'=> 'required|boolean',
            'recorrente' => 'required|boolean',
            'num_meses' => $validaMeses
        ]);

        $receita = new Receita([
            'user_id' => $request['user_id'],
            'nome' => $request['nome'],
            'valor' => $request['valor'],
            'data_vencimento' => $request['data_vencimento'],
            'descricao' => $request['descricao'],
            'categoria_id' => $request['categoria_id'],
            'forma_pagamento' => $request['forma_pagamento'],
            'disponivel' => $request['disponivel'],
            'fixa'=> $request['fixa'],
            'recorrente' => $request['recorrente'],
            'num_meses' => $request['num_meses']
        ]);
        $receita->save();

        return redirect('/receitas')->with('success-receita', 'Receita(Entrada) Cadastrada com Sucesso');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $receita = Receita::find($id);

        return redirect('/receitas#modal-receita')->with('receita',$receita);
    }

    public function update(Request $request, $id)
    {
        if($request->get('recorrente') == 1) {
            $validaMeses = 'required|integer';
        } else {
            $validaMeses = 'integer';
        }
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|between:0,99999999.99',
            'data_vencimento' => 'required|date',
            'descricao' => 'required|string|max:255',
            'categoria_id' => 'required|integer',
            'forma_pagamento' => 'required|string|max:255',
            'disponivel' => 'required|boolean',
            'fixa'=> 'required|boolean',
            'recorrente' => 'required|boolean',
            'num_meses' => $validaMeses
        ]);
        
        $receita = Receita::find($id);
        $receita->user_id = $request->get('user_id');
        $receita->nome = $request->get('nome');
        $receita->valor = $request->get('valor');
        $receita->data_vencimento = $request->get('data_vencimento');
        $receita->descricao = $request->get('descricao');
        $receita->categoria_id = $request->get('categoria_id');
        $receita->forma_pagamento = $request->get('forma_pagamento');
        $receita->disponivel = $request->get('disponivel');
        $receita->fixa = $request->get('fixa');
        $receita->recorrente = $request->get('recorrente');
        $receita->num_meses = $request->get('num_meses');
        $receita->save();

        return redirect('/receitas')->with('success-receita', 'Receita(Entrada) Alterada com Sucesso');
    }

    public function destroy($id)
    {
        $receita = Receita::find($id);
        $receita->delete();

        return redirect('/receitas')->with('sucess-receita', 'Receita(Entrada) Removida com Sucesso');
    }
}