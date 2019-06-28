@extends('layouts.app')

@section('content')

    <!-- Se existir despesa setada para edição-->
    @if(session()->get('despesa'))
        <?php $desedit = Session::get('despesa'); ?>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Despesas</h1>

    <div class="row">

    <div class="col-md-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-6">
            <div class="card-header bg-danger text-white d-flex justify-content-between">
                <span>Despesas</span>
                <a class="btn btn-light btn-circle btn-sm text-success" data-toggle="modal" data-target=".modal-despesa">
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
                            @foreach($despesas as $despesa)
                            <tr>
                                <td>{{ $despesa->nome }}</td>
                                <td>{{ $despesa->descricao }}</td>
                                @foreach($categorias as $categoria)
                                    @if($despesa->categoria_id == $categoria->id)
                                        <td>{{ $categoria->nome }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $despesa->data_vencimento }}</td>
                                <td>{{ $despesa->valor }}</td>
                                <td>@if($despesa->pago == 1)  Paga @else Em Aberto @endif</td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{ route('despesas.edit',$despesa->id)}}" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('despesas.destroy',$despesa->id) }}" method="post">
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

    <!--Modal despesa-->
    <div class="modal fade modal-despesa" id="modal-despesa" tabindex="-1" role="dialog" aria-labelledby="modal-despesa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h3 class="text-white font-weight-bold">Despesas</h3>
                </div>
                <form method="post" 
                    @if(!empty($desedit)) 
                        action="{{ route('despesas.update',  $desedit->id) }}" >
                        @method('PATCH')
                    @else 
                        action="{{ route('despesas.store') }}" >
                    @endif 
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                @csrf
                                <label for="">Nome</label>
                                <input type="text" class="form-control shadow-sm" name="nome"
                                value="@if(isset($desedit)){{ $desedit->nome }}@endif">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Valor (R$)</label>
                                <input type="number" id="money" min="0" step="0.01" class="form-control shadow-sm" name="valor"
                                value="@if(isset($desedit)){{ $desedit->valor }}@endif">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Vencimento</label>
                                <input type="date" class="form-control shadow-sm" name="data_vencimento"
                                value="@if(isset($desedit)){{ $desedit->data_vencimento }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">Descrição</label>
                                <input type="text" class="form-control shadow-sm" name="descricao"
                                value="@if(isset($desedit)){{ $desedit->descricao }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="categoria_id">Categoria</label>
                                <select name="categoria_id" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione a Categoria</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            @if(isset($desedit) && $desedit->categoria_id == $categoria->id) selected @endif>
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
                                    <input id='pagoCheckHidden' type='hidden' value='0' name='pago'>
                                    <input id="pagoCheck" class="form-check-input" type="checkbox" value="1" name="pago" 
                                    @if(isset($desedit) && $desedit->pago == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Está pago?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-1 mt-1">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-check d-flex flex-row align-items-lg-center">
                                    <input id='parceladoCheckHidden' type='hidden' value='0' name='parcelado'>
                                    <input id="parceladoCheck" class="form-check-input" type="checkbox" value="1" name="parcelado" 
                                    @if(isset($desedit) && $desedit->parcelado == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Parcelado
                                    </label>
                                    <label class="form-check-label">
                                        &nbsp;&nbsp;&nbsp; (Vencimento)
                                    </label>
                                    <input type="number" min="0" max="31" class="form-control w-25 ml-3 shadow-sm" name="dia_cobranca_parcela"
                                    @if(isset($desedit)) value="{{ $desedit->dia_cobranca_parcela }}" @else value="0" @endif>
                                    <label class="form-check-label">
                                        &nbsp;&nbsp;&nbsp; (Parcelas)
                                    </label>
                                    <input type="number" class="form-control w-25 ml-3 shadow-sm" name="num_parcelas"
                                    @if(isset($desedit)) value="{{ $desedit->num_parcelas }}" @else value="0" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-check d-flex flex-row align-items-lg-center">
                                    <input id='notificarCheckHidden' type='hidden' value='0' name='notificar'>
                                    <input id="notificarCheck" class="form-check-input" type="checkbox" value="1" name="notificar" 
                                    @if(isset($desedit) && $desedit->notificar == 1)
                                        checked="checked" >
                                    @endif
                                    <label class="form-check-label">
                                        Notificar (Meses)
                                    </label>
                                    <input type="number" class="form-control w-25 ml-3 shadow-sm" name="num_meses"
                                    @if(isset($desedit)) value="{{ $desedit->num_meses }}" @else value="0" @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" 
                        @if(isset($desedit))
                            value="{{ $desedit->user_id }}"
                        @else
                            value="{{ Auth::user()->id }}"
                        @endif > 
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal"
                            onclick="window.location.href='{{ url('/despesas') }}'">
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
