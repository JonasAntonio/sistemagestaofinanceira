<?php
//use Symfony\Component\Routing\Annotation\Route;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('home', 'HomeController');

Route::resource('categorias', 'CategoriaController');

Route::resource('receitas', 'ReceitaController');

Route::resource('despesas', 'DespesaController');

Route::resource('cartoes_credito', 'CartaoCreditoController');

Route::resource('metas_orcamentarias', 'MetaOrcamentariaController');

Route::resource('user', 'UserController');
