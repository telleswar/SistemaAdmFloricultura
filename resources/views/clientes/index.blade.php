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

        .card-text, .col-form-label{
            text-align: left;
        }

        .btn-add{
            margin-left: 2%;
        }

        .submit{
            margin-top: 1%;
        }

    </style>
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3>Lista de clientes
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    Novo cliente
                </button>
            </h3>
            <hr class="mt-3">
        </div>

        @include('clientes.create')

        <div class="row text-center">
            @foreach ($Clientes as $cliente)
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center ">
                    <div class="card bg-dark">
                        <div class="card-header">
                            <h2>Cliente: {{$cliente->id}} | {{$cliente->nome}}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Telefone: {{$cliente->telefone}}</p>
                            <p class="card-text">Email: {{$cliente->email}}</p>
                            <p class="card-text">Endereço: {{$cliente->endereco}}</p>
                            <p class="card-text">Documento: {{$cliente->cpf}}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editar-{{$cliente->id}}">
                                <ion-icon name="pencil-outline" title="Editar"></ion-icon>
                            </button>
                            @include('clientes.edit')
                            <a href="{{ Route('clientes.destroy',['cliente' => $cliente->id])}}"><button class="btn btn-danger">
                                <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                            </button></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
