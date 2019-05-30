<?php

namespace App\Http\Controllers;

use App\Despesa;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DespesaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Busca categorias de um usuario especifico e do tipo despesa
        $categorias = Categoria::where('user_id', Auth::user()->id)->where('receita', 1)->orWhere('receita', 2)->get();
        //Busca despesas de um usuario especifico
        $despesas = Despesa::where('user_id', Auth::user()->id)->get();
        return view('dashboard/despesas', compact('categorias','despesas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if($request->get('parcelado') == 1) {
            $validaCobrancaParcela = 'required|integer';
            $validaParcelas = 'required|integer';
        } else {
            $validaCobrancaParcela = 'integer';
            $validaParcelas = 'integer';
        }

        if($request->get('notificar') == 1) {
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
            'pago' => 'required|boolean',
            'parcelado'=> 'required|boolean',
            'dia_cobranca_parcela' => $validaCobrancaParcela,
            'num_parcelas' => $validaParcelas,
            'notificar'=> 'required|boolean',
            'num_meses' => $validaMeses
        ]);

        $despesa = new Despesa([
            'user_id' => $request['user_id'],
            'nome' => $request['nome'],
            'valor' => $request['valor'],
            'data_vencimento' => $request['data_vencimento'],
            'descricao' => $request['descricao'],
            'categoria_id' => $request['categoria_id'],
            'forma_pagamento' => $request['forma_pagamento'],
            'pago' => $request['pago'],
            'parcelado'=> $request['parcelado'],
            'dia_cobranca_parcela' => $request['dia_cobranca_parcela'],
            'num_parcelas' => $request['num_parcelas'],
            'notificar' => $request['notificar'],
            'num_meses' => $request['num_meses']
        ]);
        $despesa->save();

        return redirect('/despesas')->with('success-despesa', 'Despesa(Saída) Cadastrada com Sucesso');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $despesa = Despesa::find($id);

        return redirect('/despesas#modal-despesa')->with('despesa',$despesa);
    }

    public function update(Request $request, $id)
    {
        if($request->get('parcelado') == 1) {
            $validaCobrancaParcela = 'required|integer';
            $validaParcelas = 'required|integer';
        } else {
            $validaCobrancaParcela = 'integer';
            $validaParcelas = 'integer';
        }

        if($request->get('notificar') == 1) {
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
            'pago' => 'required|boolean',
            'parcelado'=> 'required|boolean',
            'dia_cobranca_parcela' => $validaCobrancaParcela,
            'num_parcelas' => $validaParcelas,
            'notificar'=> 'required|boolean',
            'num_meses' => $validaMeses
        ]);
        
        $despesa = Despesa::find($id);
        $despesa->user_id = $request->get('user_id');
        $despesa->nome = $request->get('nome');
        $despesa->valor = $request->get('valor');
        $despesa->data_vencimento = $request->get('data_vencimento');
        $despesa->descricao = $request->get('descricao');
        $despesa->categoria_id = $request->get('categoria_id');
        $despesa->forma_pagamento = $request->get('forma_pagamento');
        $despesa->pago = $request->get('pago');
        $despesa->parcelado = $request->get('parcelado');
        $despesa->dia_cobranca_parcela = $request->get('dia_cobranca_parcela');
        $despesa->num_parcelas = $request->get('num_parcelas');
        $despesa->notificar = $request->get('notificar');
        $despesa->num_meses = $request->get('num_meses');
        $despesa->save();

        return redirect('/despesas')->with('success-despesa', 'Despesa(Saída) Alterada com Sucesso');
    }

    public function destroy($id)
    {
        $despesa = Despesa::find($id);
        $despesa->delete();

        return redirect('/despesas')->with('sucess-despesa', 'Despesa(Saída) Removida com Sucesso');
    }
}
