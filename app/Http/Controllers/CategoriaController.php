<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Busca a categoria cadastrada pelo Usuário especifico
        $categorias = Categoria::where('user_id', Auth::user()->id)->get();
        return view('dashboard/categorias', compact('categorias'));
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
            'descricao' => 'required|string|max:255',
            'receita' => 'required|integer',
            'cor' => 'required|string|max:255'
        ]);

        $categoria = new Categoria([
            'user_id' => $request['user_id'],
            'nome' => $request['nome'],
            'descricao' => $request['descricao'],
            'receita' => $request['receita'],
            'cor' =>$request['cor']
        ]);
        $categoria->save();

        if($categoria->receita) {
            return redirect('/categorias')->with('success-receita', 'Categoria Cadastrada com Sucesso');
        } else {
            return redirect('/categorias')->with('success-despesa', 'Categoria Cadastrada com Sucesso');
        } 
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categoria = Categoria::find($id);
        
        return redirect('/categorias#modal-categoria')->with('categoria',$categoria);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'receita' => 'required|integer',
            'cor' => 'required|string|max:255'
        ]);
    
        $categoria = Categoria::find($id);
        $categoria->user_id = $request->get('user_id');
        $categoria->nome = $request->get('nome');
        $categoria->descricao = $request->get('descricao');
        $categoria->receita = $request->get('receita');
        $categoria->cor = $request->get('cor');
        $categoria->save();
    
        if($categoria->receita) {
            return redirect('/categorias')->with('success-receita', 'Categoria Alterada com Sucesso');
        } else {
            return redirect('/categorias')->with('success-despesa', 'Categoria Alterada com Sucesso');
        }   
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        if($categoria->receita) {
            return redirect('/categorias')->with('success-receita', 'Categoria Removida com Sucesso');
        } else {
            return redirect('/categorias')->with('success-despesa', 'Categoria Removida com Sucesso');
        }
    }
}
