<?php

namespace App\Http\Controllers;

use App\Meta_Orcamentaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetaOrcamentariaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Busca a categoria cadastrada pelo Usuário especifico
        $metas = Meta_Orcamentaria::where('user_id', Auth::user()->id)->get();
        return view('dashboard/metas_orcamentarias', compact('metas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|between:0,999999.99',
            'saldo' => 'required|numeric|between:0,999999.99',
            'dataFinal' => 'required|date',
            'situacao' => 'required|integer'
        ]);

        $meta = new Meta_Orcamentaria([
            'user_id' => $request['user_id'],
            'nome' => $request['nome'],
            'valor' => $request['valor'],
            'saldo' => $request['saldo'],
            'dataFinal' =>$request['dataFinal'], 
            'situacao' =>$request['situacao']
        ]);
        $meta->save();

        notify()->success('Meta Orçamentaria ' . $meta->nome .' Cadastrada com Sucesso' , Auth::user()->name);
        return redirect('/metas_orcamentarias');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $meta = Meta_Orcamentaria::find($id);
        
        return redirect('/metas_orcamentarias#modal-meta')->with('meta',$meta);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric|between:0,999999.99',
            'saldo' => 'required|numeric|between:0,999999.99',
            'dataFinal' => 'required|date',
            'situacao' => 'required|integer'
        ]);
    
        $meta = Meta_Orcamentaria::find($id);
        $meta->user_id = $request->get('user_id');
        $meta->nome = $request->get('nome');
        $meta->valor = $request->get('valor');
        $meta->saldo = $request->get('saldo');
        $meta->dataFinal = $request->get('dataFinal');
        $meta->situacao = $request->get('situacao');
        $meta->save();

        notify()->success('Meta Orçamentaria ' . $meta->nome .' Alterada com Sucesso' , Auth::user()->name);
        return redirect('/metas_orcamentarias');
    }

    public function destroy($id)
    {
        $meta = Meta_Orcamentaria::find($id);
        notify()->success('Meta Orçamentaria ' . $meta->nome .' Removida com Sucesso' , Auth::user()->name);
        $meta->delete();

        return redirect('/metas_orcamentarias');
    }
}
