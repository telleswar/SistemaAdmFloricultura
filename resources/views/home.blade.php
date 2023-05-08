@extends('layouts.base')

@section('head')

@endsection

@section('content')
<div id="lista-pedidos" class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Lista de pedidos</h3>
            <hr class="mt-3">
        </div>

        @if ($errors->any())
            <div id="alerta"class="flex justify-between text-red-200 shadow-inner rounded p-3 bg-red-500">
                <p class="self-center"><strong>Alerta  </strong>Não foi possível salvar os dados.</p>
                <strong class="text-x1 align-center cursor-pointer alert-del">&times;</strong>
            </div>    
        @elseif (session('sucess'))
            <div id="alerta"class="flex justify-between text-green-200 shadow-inner rounded p-3 bg-green-500">
                <p class="self-center"><strong>Sucesso  </strong>{{session('sucess')}}</p>
                <strong class="text-x1 align-center cursor-pointer alert-del">&times;</strong>
            </div>  
        @endif

        <div class="row text-center">
            @foreach ($Pedidos as $pedido)
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center ">
                    <div class="card bg-dark">                        
                        <div class="card-header">
                            <h2 class="card-nome-cliente"><ion-icon name="reader-outline"></ion-icon># {{$pedido->numero}} | {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y')}}</p>
                            <h2 class="card-nome-cliente">{{$pedido->cliente->nome}} </h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Valor total: R$ {{$pedido->valor_total}}</p>
                        </div>
                        <div class="card-footer">
                            <a href=""><button class="btn btn-primary">Detalhes</button><br></a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{$Pedidos->links()}}
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
