@extends('layouts.app')

@section('content')

    <!-- Se existir meta setada para edição-->
    @if(session()->get('meta'))
        <?php $metaedit = Session::get('meta'); ?>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Minhas metas</h1>
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

    @foreach($metas->chunk(3) as $chunked_metas)
    <div class="row">
        @foreach($chunked_metas as $meta)
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h6 class="font-weight-bold">
                                <i class="fas fa-car"></i>
                                {{ $meta->nome }}
                            </h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            Data final da meta:
                            <div>
                                {{ $meta->dataFinal }}
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <h4>{{ number_format($meta->saldo / $meta->valor * 100, 2) }}%</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress mt-3 mb-2">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ number_format($meta->saldo / $meta->valor * 100, 2) }}%;"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format($meta->saldo / $meta->valor * 100, 2) }}%</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6>R$ {{ $meta->saldo }} / R$ {{ $meta->valor }}</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <form action="{{ route('metas_orcamentarias.destroy',$meta->id) }}" method="post">
                                <a href="" title="Concluir Meta">
                                    <i class="fas fa-check-double text-success"></i>
                                </a>
                                <a href="{{ route('metas_orcamentarias.edit',$meta->id) }}" class="ml-3" 
                                    title="Editar Meta" >
                                    <i class="fas fa-pencil-alt text-secondary"></i>
                                </a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" type="submit" title="Remover Meta">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    @endforeach

    <div style="position: fixed; bottom:80px; right: 30px;">
        <a href="" style="font-size: 50px;" data-toggle="modal" data-target=".modal-meta">
            <i class="text-info fas fa-plus-circle"></i>
        </a>
    </div>

    <!--Modal de meta-->
    <div class="modal fade modal-meta" id="modal-meta" tabindex="-1" role="dialog" aria-labelledby="modal-meta"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form  method="post"
                    @if(!empty($metaedit)) 
                    {{ $metaedit }}
                        action="{{ route('metas_orcamentarias.update',  $metaedit->id) }}" >
                        @method('PATCH')
                    @else 
                        action="{{ route('metas_orcamentarias.store') }}" >
                    @endif
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">
                                    <i class="fas fa-chart-pie"></i>
                                    Nova meta
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                @csrf
                                <label for="">Nome</label>
                                <input type="text" class="form-control shadow-sm" name="nome"
                                value="@if(isset($metaedit)){{ $metaedit->nome }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Valor necessário (R$)</label>
                                <input type="text" class="form-control shadow-sm money" name="valor"
                                value="@if(isset($metaedit)){{ $metaedit->valor }}@endif">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Saldo inicial (R$)</label>
                                <input type="text" class="form-control shadow-sm money" name="saldo"
                                value="@if(isset($metaedit)){{ $metaedit->saldo }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Data final</label>
                                <input type="date" class="form-control shadow-sm date" name="dataFinal"
                                value="@if(isset($metaedit)){{ $metaedit->dataFinal }}@endif">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="situacao" 
                            @if(isset($metaedit))
                                value="{{ $metaedit->situacao }}"
                            @else
                                value="1"
                            @endif >
                    <input type="hidden" name="user_id" 
                            @if(isset($metaedit))
                                value="{{ $metaedit->user_id }}"
                            @else
                                value="{{ Auth::user()->id }}"
                            @endif >
                    <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal"
                            onclick="window.location.href='{{ url('/metas_orcamentarias') }}'">
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
    <!--Fim do modal de meta-->

@endsection