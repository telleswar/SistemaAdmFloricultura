@extends('layouts.base')

@section('head')
    <style>
        .card-header h2{
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .card {
            min-width: 280px;
            max-width: 280px;
            overflow: hidden;
            margin-bottom: 25px;
        }

    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3>Lista de pedidos</h3>
            <hr class="mt-3">
        </div>

        <div class="row text-center">
            @foreach ($Pedidos as $pedido)
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center ">
                    <div class="card bg-dark">
                        <div class="card-header">
                            <h2>Pedido: {{$pedido->numero}} | {{$pedido->cliente->nome}} | {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y')}}</h2>
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
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
