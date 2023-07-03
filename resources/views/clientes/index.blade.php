@extends('layouts.base')

@section('head')
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Lista de clientes
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    <ion-icon name="person-add-outline"></ion-icon> Novo cliente
                </button>
            </h3>
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

        
        
        @include('clientes.create')

        <div class="row text-center">
            @foreach ($Clientes as $cliente)
                <div id="lista-clientes" class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center ">
                    <div class="card bg-dark">
                        <div class="card-header">
                            <h2><ion-icon name="person-outline"></ion-icon># {{$cliente->id}} | {{$cliente->nome}}</h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><ion-icon name="call-outline"></ion-icon>Telefone: {{$cliente->telefone}}</p>
                            <p class="card-text"><ion-icon name="mail-outline"></ion-icon>Email: {{$cliente->email}}</p>
                            <p class="card-text"><ion-icon name="location-outline"></ion-icon>Endereço: {{$cliente->endereco}}</p>
                            <p class="card-text"><ion-icon name="document-outline"></ion-icon>Documento: {{$cliente->cpf}}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editar-{{$cliente->id}}">
                                <ion-icon name="pencil-outline" title="Editar"></ion-icon>
                            </button>
                            @include('clientes.delete')
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$cliente->id}}">
                                <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
                @include('clientes.edit')
            @endforeach
            {{$Clientes->links()}}
        </div>
       
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
