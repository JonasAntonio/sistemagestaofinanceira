<?php

namespace App\Http\Controllers;
use App\Despesa;
use App\Receita;
use Illuminate\Support\Facades\Auth;
use App\Categoria;
use Khill\Lavacharts\Lavacharts;

class HomeController extends Controller
{
    private $num = 0;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lava = new Lavacharts;

        $totalReceitas = $this->totalReceitas();
        $totalDespesas = $this->totalDespesas();

        //Chamando os gráficos
        self::receitaCategoriaChart($lava);
        self::despesaCategoriaChart($lava);
        
        notify()->info('Bem-Vindo ' . Auth::user()->name , 'IMPEAKABLE');
        return view('home', compact('totalReceitas','totalDespesas','lava'));
    }

    private function totalReceitas() {
        $receitasColecao = Receita::where('user_id', Auth::user()->id)->get();
        $soma = 0;
        foreach ($receitasColecao as $key => $value) {
            $soma += $value->valor;
        }
        return $soma;
    }

    private function totalDespesas() {
        $despesasColecao = Despesa::where('user_id', Auth::user()->id)->get();
        $soma = 0;
        foreach ($despesasColecao as $key => $value) {
            $soma += $value->valor;
        }
        return $soma;
    }

    private static function receitaCategoriaChart($lava) {
        //Pegamos o Id e Nome das Categorias de Receita --- 0 e 2
        $categoriasIdNome = Categoria::where('user_id', Auth::user()->id)->where('receita', 0)->orWhere('receita', 2)->select('id','nome','cor')->get();
        $receitaIdValor = Receita::where('user_id', Auth::user()->id)->select('categoria_id', 'valor')->get();
        $cores = array();

        $formato = $lava->NumberFormat([
            'prefix'            => 'R$ '
        ]);

        $reasons = $lava->DataTable();
        $reasons->addStringColumn('Categoria')
                ->addNumberColumn('Valor', $formato, 'scope');
        foreach ($categoriasIdNome as $key => $categoria) {
            $soma = 0;
            foreach ($receitaIdValor as $key => $receita) {
                if($receita->categoria_id == $categoria->id) {
                    $soma+= $receita->valor;
                }
            }
            $reasons->addRow([$categoria->nome, $soma]);
            $cores[] = [$categoria->cor];
        }

        $lava->DonutChart('ReceitaCategoria', $reasons, [
            'colors'            => $cores,
            //Buraco central de 0 a 1 (Float)
            'pieHole'           => 0.70,
            //'height'            => 300,
            //'width'             => 450,
            'fontSize'          => 16,
        ]);
    }

    private static function despesaCategoriaChart($lava) {
        //Pegamos o Id e Nome das Categorias de Despesa --- 1 e 2
        $categoriasIdNome = Categoria::where('user_id', Auth::user()->id)->where('receita', 1)->orWhere('receita', 2)->select('id','nome','cor')->get();
        $despesaIdValor = Despesa::where('user_id', Auth::user()->id)->select('categoria_id','valor')->get();
        $cores = array();

        $formato = $lava->NumberFormat([
            'prefix'            => 'R$ '
        ]);

        $reasons = $lava->DataTable();
        $reasons->addStringColumn('Categoria')
                ->addNumberColumn('Valor', $formato);
        foreach ($categoriasIdNome as $key => $categoria) {
            $soma = 0;
            foreach ($despesaIdValor as $key => $despesa) {
                if($despesa->categoria_id == $categoria->id) {
                    $soma+= $despesa->valor;
                }
            }
            $reasons->addRow([$categoria->nome, $soma]);
            $cores[] = [$categoria->cor];
        }

        $lava->DonutChart('DespesaCategoria', $reasons, [
            'colors'            => $cores,
            //Buraco central de 0 a 1 (Float)
            'pieHole'           => 0.70,
            //'height'            => 300,
            //'width'             => 450,
            'fontSize'          => 16,
        ]);

        
    }
}
