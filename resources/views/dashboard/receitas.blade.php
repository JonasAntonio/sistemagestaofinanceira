@extends('layouts.app')

@section('content')

    <!-- Se existir receita setada para edição-->
    @if(session()->get('receita'))
        <?php $recedit = Session::get('receita'); ?>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Receitas</h1>

    <div class="row">

    <div class="col-md-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-6">
            <div class="card-header bg-info text-white d-flex justify-content-between">
                <span>Receitas</span>
                <a class="btn btn-light btn-circle btn-sm text-success" data-toggle="modal" data-target=".modal-receita">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
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
               
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Vencimento</th>
                            <th>Valor (R$)</th>
                            <th>Situação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($receitas as $receita)
                            <tr>
                                <td>{{ $receita->nome }}</td>
                                <td>{{ $receita->descricao }}</td>
                                @foreach($categorias as $categoria)
                                    @if($receita->categoria_id == $categoria->id)
                                        <td>{{ $categoria->nome }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $receita->data_vencimento }}</td>
                                <td>{{ $receita->valor }}</td>
                                <td>@if($receita->disponivel == 1) Disponível @else Não Disponível @endif</td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('receitas.edit',$receita->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('receitas.destroy',$receita->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="ml-1 btn btn-danger btn-circle btn-sm" type="submit">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--Modal receita-->
    <div class="modal fade modal-receita"  id="modal-receita" tabindex="-1" role="dialog" aria-labelledby="modal-receita" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h3 class="text-white font-weight-bold">Receita</h3>
                </div>
                <form method="post" 
                    @if(!empty($recedit)) 
                        action="{{ route('receitas.update',  $recedit->id) }}" >
                        @method('PATCH')
                    @else 
                        action="{{ route('receitas.store') }}" >
                    @endif 
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                @csrf
                                <label for="">Nome</label>
                                <input type="text" class="form-control shadow-sm" name="nome"
                                value="@if(isset($recedit)){{ $recedit->nome }}@endif">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Valor (R$)</label>
                                <input type="number" id="money" min="0" step="0.01" class="form-control shadow-sm" name="valor"
                                value="@if(isset($recedit)){{ $recedit->valor }}@endif">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Vencimento</label>
                                <input type="date" class="form-control shadow-sm" name="data_vencimento"
                                value="@if(isset($recedit)){{ $recedit->data_vencimento }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Descrição</label>
                                <input type="text" class="form-control shadow-sm" name="descricao"
                                value="@if(isset($recedit)){{ $recedit->descricao }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="categoria_id">Categoria</label>
                                <select name="categoria_id" id="" class="form-control shadow-sm">
                                        <option value="" selected disabled hidden >Selecione a Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            @if(isset($recedit) && $recedit->categoria_id == $categoria->id) selected @endif>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="forma_pagamento">Forma pagamento</label>
                                <select name="forma_pagamento" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione a Forma de Pagamento</option>
                                    <option value="Cartão de Crédito">
                                        Cartão de Crédito
                                    </option>
                                    <option value="Dinheiro">
                                        Dinheiro
                                    </option>
                                    <option value="Deposito">
                                        Deposito
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input id='disponivelCheckHidden' type='hidden' value='0' name='disponivel'>
                                    <input id="disponivelCheck" class="form-check-input" type="checkbox" value="1" name="disponivel" 
                                    @if(isset($recedit) && $recedit->disponivel == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Está disponível?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input id='fixaCheckHidden' type='hidden' value='0' name='fixa'>
                                    <input id="fixaCheck" class="form-check-input" type="checkbox" value="1" name="fixa" 
                                    @if(isset($recedit) && $recedit->fixa == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Receita fixa
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check d-flex flex-row align-items-lg-center">
                                    <input id='recorrenteCheckHidden' type='hidden' value='0' name='recorrente'>
                                    <input id="recorrenteCheck" class="form-check-input" type="checkbox" value="1" name="recorrente" 
                                    @if(isset($recedit) && $recedit->recorrente == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Receita recorrente (meses)
                                    </label>
                                    <input type="number" class="form-control w-25 ml-3 shadow-sm" name="num_meses"
                                    @if(isset($recedit)) value="{{ $recedit->num_meses }}" @else value="0" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" 
                            @if(isset($recedit))
                                value="{{ $recedit->user_id }}"
                            @else
                                value="{{ Auth::user()->id }}"
                            @endif > 
                    <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal"
                            onclick="window.location.href='{{ url('/receitas') }}'">
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
