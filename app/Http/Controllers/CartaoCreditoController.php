<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartao_Credito;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Array_;

class CartaoCreditoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bandeiras = Array(1 => 'Visa', 
                           2 => 'Mastercard',
                           3 => 'American Express',
                           4 => 'Elo',
                           5 => 'Discover Network',
                           6 => 'Hipercard',
                           7 => 'Diners Club',
                           8 => 'Sorocred',);
        //Busca a categoria cadastrada pelo Usuário especifico
        $cartoes = Cartao_Credito::where('user_id', Auth::user()->id)->get();
        return view('dashboard/cartoes_credito', compact('cartoes','bandeiras'));
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
            'limite' => 'required|numeric|between:0,999999.99',
            'bandeira' => 'required|integer',
            'diaPagamento' => 'required|integer',
            'diaFechamento' => 'required|integer'
        ]);

        $cartao = new Cartao_Credito([
            'user_id' => $request['user_id'],
            'nome' => $request['nome'],
            'limite' => $request['limite'],
            'bandeira' => $request['bandeira'],
            'diaPagamento' =>$request['diaPagamento'], 
            'diaFechamento' =>$request['diaFechamento']
        ]);
        $cartao->save();

        return redirect('/cartoes_credito')->with('success-cartao', 'Cartão Cadastrado com Sucesso');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cartao = Cartao_Credito::find($id);
        
        return redirect('/cartoes_credito#modal-cartao')->with('cartao',$cartao);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'limite' => 'required|numeric|between:0,999999.99',
            'bandeira' => 'required|integer',
            'diaPagamento' => 'required|integer',
            'diaFechamento' => 'required|integer'
        ]);
    
        $cartao = Cartao_Credito::find($id);
        $cartao->user_id = $request->get('user_id');
        $cartao->nome = $request->get('nome');
        $cartao->limite = $request->get('limite');
        $cartao->bandeira = $request->get('bandeira');
        $cartao->diaPagamento = $request->get('diaPagamento');
        $cartao->diaFechamento = $request->get('diaFechamento');
        $cartao->save();
    
        return redirect('/cartoes_credito')->with('success-cartao', 'Cartão Alterado com Sucesso');
    }

    public function destroy($id)
    {
        $cartao = Cartao_Credito::find($id);
        $cartao->delete();

        return redirect('/cartoes_credito')->with('success-cartao', 'Cartão Removido com Sucesso');
    }
}