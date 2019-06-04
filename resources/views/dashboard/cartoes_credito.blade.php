@extends('layouts.app')

@section('content')
 
    <!-- Se existir categoria setada para edição-->
    @if(session()->get('cartao'))
        <?php $cartaoedit = Session::get('cartao'); ?>
    @endif

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Cartões</h1>
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

    @if(session()->get('success-cartao'))
        <div class="alert alert-success" id="divalert">
            {{ session()->get('success-cartao') }}  
        </div>
    @endif

    @foreach($cartoes->chunk(3) as $chunked_cartoes)
    <div class="row">
        @foreach($chunked_cartoes as $cartao)
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6 class="font-weight-bold">
                                <i class="far fa-credit-card"></i>
                                {{ $cartao->nome }}
                            </h6>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <a href="{{ route('cartoes_credito.edit',$cartao->id) }}">
                                <i class="text-warning fas fa-pen"></i>
                            </a>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <form action="{{ route('cartoes_credito.destroy',$cartao->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link" type="submit">
                                    <i class="text-danger fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="progress mt-3 mb-2">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">25%</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Saldo restante: <span class="text-success font-weight-bold">R$ 800.00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Fatura atual: <span class="text-danger font-weight-bold">R$ 1200.00</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Limite: <span class="font-weight-bold">R$ {{ $cartao->limite }}</span>
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
        <a href="" style="font-size: 50px;" data-toggle="modal" data-target=".modal-cartao">
            <i class="text-info fas fa-plus-circle"></i>
        </a>
    </div>

    <!--Modal cartao de credito-->
    <div class="modal fade modal-cartao" id="modal-cartao" tabindex="-1" role="dialog" aria-labelledby="modal-cartao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form method="post" 
                    @if(!empty($cartaoedit)) 
                        action="{{ route('cartoes_credito.update',  $cartaoedit->id) }}" >
                        @method('PATCH')
                    @else 
                        action="{{ route('cartoes_credito.store') }}" >
                    @endif 
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">
                                    <i class="far fa-credit-card"></i>
                                    Novo cartão
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                @csrf
                                <label for="">Nome</label>
                                <input type="text" class="form-control shadow-sm" name="nome"
                                value="@if(isset($cartaoedit)){{ $cartaoedit->nome }}@endif">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Limite (R$)</label>
                                <input type="text" class="form-control shadow-sm money" name="limite"
                                value="@if(isset($cartaoedit)){{ $cartaoedit->limite }}@endif">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Bandeira</label>
                                <select name="bandeira" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione a Bandeira do Cartão</option>
                                    @foreach ($bandeiras as $key=>$value)
                                        <option value="{{ $key }}" @if(isset($cartaoedit) && $cartaoedit->bandeira==$key) selected @endif >
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Vincular à conta</label>
                                <select name="" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione a Conta Vinculada</option>
                                    <option value="0">
                                        CEF
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Dia de fechamento</label>
                                <select name="diaFechamento" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione o Dia de Fechamento</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" @if(isset($cartaoedit) && $cartaoedit->diaFechamento==$i) selected @endif>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Dia de pagamento</label>
                                <select name="diaPagamento" id="" class="form-control shadow-sm">
                                    <option value="" selected disabled hidden >Selecione o Dia de Pagamento</option>
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" @if(isset($cartaoedit) && $cartaoedit->diaPagamento==$i) selected @endif>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" 
                            @if(isset($cartaoedit))
                                value="{{ $cartaoedit->user_id }}"
                            @else
                                value="{{ Auth::user()->id }}"
                            @endif >
                    <div class="modal-footer">
                            <button class="btn btn-danger" data-dismiss="modal"
                            onclick="window.location.href='{{ url('/cartoes_credito') }}'">
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