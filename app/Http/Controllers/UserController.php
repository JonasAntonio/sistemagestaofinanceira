<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'endereco' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'cpf' => 'required|string|max:255',
            'rg' => 'required|string|max:255',
            'dataNascimento' => 'required|date',
        ]);
    
        $usuario = User::find(Auth::user()->id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->endereco = $request->get('endereco');
        $usuario->bairro = $request->get('bairro');
        $usuario->cidade = $request->get('cidade');
        $usuario->numero = $request->get('numero');
        $usuario->cpf = $request->get('cpf');
        $usuario->rg = $request->get('rg');
        $usuario->dataNascimento = $request->get('dataNascimento');
        $usuario->save();
        
        notify()->success('Perfil Alterado com Sucesso' , Auth::user()->name);
        return redirect()->back();
    }
}
