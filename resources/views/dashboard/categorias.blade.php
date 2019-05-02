@extends('layouts.app')

@section('content')

    <!-- Se existir categoria setada para edição-->
    @if(session()->get('categoria'))
        <?php $catedit = Session::get('categoria'); ?>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Categorias</h1>
    <!-- Se existirem erros a serem mostrados exibe aqui -->
    @if ($errors->any())
        <div class="alert alert-danger" id="divalert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
    <div class="col-md-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-6">
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <span>
                Receitas
                </span>
                <a class="btn btn-light btn-circle btn-sm text-success" data-toggle="modal" data-target=".modal-categoria">
                <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <!-- Se existirem sucessos a serem mostrados exibe aqui -->
                @if(session()->get('success-receita'))
                    <div class="alert alert-success" id="divalert">
                        {{ session()->get('success-receita') }}  
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>Descrição</td>
                            <td>Cor</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            @if($categoria->receita == 1)
                            <tr>
                                <td>{{ $categoria->nome }}</td>
                                <td>{{ $categoria->descricao }}</td>
                                <td style="background-color:{{ $categoria->cor }}"></td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('categorias.edit',$categoria->id)}}" class="btn btn-primary btn-circle btn-sm">
                                    <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy',$categoria->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ml-1 btn btn-danger btn-circle btn-sm" type="submit">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-6">
            <div class="card-header bg-danger text-white d-flex justify-content-between">
                <span>Despesas</span>
                <a class="btn btn-light btn-circle btn-sm text-success" data-toggle="modal" data-target=".modal-categoria">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <!-- Se existirem sucessos a serem mostrados exibe aqui -->
                @if(session()->get('success-despesa'))
                    <div class="alert alert-success" id="divalert">
                        {{ session()->get('success-despesa') }}  
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Nome</td>
                            <td>Descrição</td>
                            <td>Cor</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            @if($categoria->receita == 0)
                            <tr>
                                <td>{{ $categoria->nome }}</td>
                                <td>{{ $categoria->descricao }}</td>
                                <td style="background-color:{{ $categoria->cor }}"></td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('categorias.edit',$categoria->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('categorias.destroy',$categoria->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ml-1 btn btn-danger btn-circle btn-sm" type="submit">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!--Modal categoria-->
    <div class="modal fade modal-categoria" id="modal-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-categoria" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h3 class="text-white font-weight-bold">Categoria</h3>
                </div>
                <form method="post" 
                    @if(!empty($catedit)) 
                        action="{{ route('categorias.update',  $catedit->id) }}" >
                        @method('PATCH')
                    @else 
                        action="{{ route('categorias.store') }}" >
                    @endif 
                   <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                @csrf
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control shadow-sm" name="nome" 
                                value="@if(isset($catedit)){{ $catedit->nome }}@endif">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nome">Cor</label>
                                <input id="colorpicker" type="text" class="form-control shadow-sm" name="cor" 
                                        value="@if(isset($catedit)){{ $catedit->cor }}@endif">
                                <script>
                                    $('#colorpicker').colorpicker({});
                                </script>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group d-flex flex-row align-items-lg-center">
                                    <input id='categoriasCheckHidden' type='hidden' value='0' name='receita'>
                                    <input id="categoriasCheck" class="form-check-input" type="checkbox" value="1" name="receita" 
                                    @if(isset($catedit) && $catedit->receita == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        É Receita?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="descricao">Descrição</label>
                                <input type="text" class="form-control shadow-sm" name="descricao" 
                                value="@if(isset($catedit)){{ $catedit->descricao }}@endif">
                            </div>
                        </div>
                        <input type="hidden" name="user_id" 
                            @if(isset($catedit))
                                value="{{ $catedit->user_id }}"
                            @else
                                value="{{ Auth::user()->id }}"
                            @endif > 
                        <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"
                            onclick="window.location.href='{{ url('/categorias') }}'">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection