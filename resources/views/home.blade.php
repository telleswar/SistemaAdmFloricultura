@extends('layouts.base')

@section('head')

@endsection

@section('content')
@include('pedidos.create')
<div id="lista-pedidos" class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Lista de pedidos
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    <ion-icon name="reader-outline"></ion-icon> Novo pedido
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

        <div class="row">
            @foreach ($Pedidos as $pedido)
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center text-center">
                    <div class="card bg-dark">                        
                        <div class="card-header">
                            <h2 class="card-nome-cliente"><ion-icon name="reader-outline"></ion-icon># {{$pedido->id}} | {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y')}}</p>
                            <h2 class="card-nome-cliente">{{$pedido->cliente->nome}} </h2>
                        </div>
                        <div class="card-body text-left">
                            @php
                                $total = 0;
                            @endphp
                            @if (count($pedido->itens_pedido) > 0)                             
                            
                                <table>
                                @foreach ($pedido->itens_pedido as $item)
                                
                                    <tr>
                                        <td>
                                            @if ($item->produto->imagem)
                                                <img id="imagem-produto" src="img/produtos/{{$item->produto->imagem}}" alt="{{$item->produto->nome}}" class="w-5 h-5 rounded-full">
                                            @else
                                                <ion-icon name="bag-outline"></ion-icon>
                                            @endif
                                        </td>
                                        <td class="card-text">{{$item->produto->nome}}</td>
                                        <td class="card-spacing"></td>
                                        <td class="card-text">x{{$item->quantidade}}</td>
                                        <td class="card-spacing"></td>
                                        <td class="card-text">R$ {{number_format((float) $item->valor, 2)}}</td>
                                    </tr>
                                
                                    @php
                                        $total += $item->valor;
                                    @endphp
                                @endforeach                       
                                <tr>     
                                    <td></td>                           
                                    <td class="card-text">ㅤㅤㅤㅤㅤ</td>
                                    <td class="card-text">ㅤ</td>
                                    <td class="card-text"></td>
                                    <td class="card-text">Total:ㅤ</td>
                                    <td class="card-text">R$ {{number_format((float) $total, 2)}}</td>
                                </tr> 
                                </table>
                            @else
                                <p class="card-text">Nenhum produto adicionado...</p>
                            @endif
                            
                            
                        </div>
                        <div class="card-footer">
                            
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editar-{{$pedido->id}}">
                                <ion-icon name="pencil-outline" title="Editar"></ion-icon>
                            </button>
                            
                            <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#add-{{$pedido->id}}">
                                <ion-icon name="add-outline" title="Adicionar"></ion-icon>
                            </button>

                            @include('pedidos.delete')
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$pedido->id}}">
                                <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                            </button>
                        </div>
                    </div>
                </div>
            @include('pedidos.edit')   
            @include('pedidos.add')   
            @endforeach

            {{$Pedidos->links()}}
        </div>
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
