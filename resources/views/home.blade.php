@extends('layouts.base')

@section('head')

@endsection

@section('content')
@include('pedidos.create')
<div id="lista-pedidos" class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Lista de pedidos e orçamentos
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    <ion-icon name="reader-outline"></ion-icon> Novo orçamento
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
        @elseif (session('warning'))
            <div id="alerta"class="flex justify-between text-yellow-200 shadow-inner rounded p-3 bg-yellow-500">
                <p class="self-center"><strong>Aviso  </strong>{{session('warning')}}</p>
                <strong class="text-x1 align-center cursor-pointer alert-del">&times;</strong>
            </div>  
        @endif

        
        <div class="row">
            
            @foreach ($Pedidos as $pedido)
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center text-center ">
                    <div class="card  @if ($pedido->status == 0)
                        bg-warning
                    @elseif ($pedido->status == 1)
                        bg-info
                    @elseif ($pedido->status == 2)
                        bg-success
                    @elseif ($pedido->status == 3)
                        bg-danger
                    @endif ">    
                        @if ($pedido->status == 0)
                            <span class="badge bg-warning">Orçamento</span> 
                        @elseif ($pedido->status == 1)
                            <span class="badge bg-info">Pedido</span> 
                        @elseif($pedido->status == 2)
                            <span class="badge bg-success">Finalizado em {{ \Carbon\Carbon::parse($pedido->data_finalizacao)->format('d/m/Y')}}</span> 
                        @elseif ($pedido->status == 3)
                            <span class="badge bg-danger">Cancelado</span> 
                        @endif                   
                        <div class="card-header">
                            <h2 class="card-nome-cliente"><ion-icon name="reader-outline"></ion-icon># {{$pedido->id}} | {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y')}}</p>
                            <h2 class="card-nome-cliente">{{$pedido->cliente->nome}} </h2>
                        </div>
                        <div class="card-body text-left ">
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
                                    <td class="card-text">R$ {{number_format((float) $pedido->valor_total, 2)}}</td>
                                </tr> 
                                </table>
                            @else
                                <p class="card-text">Nenhum produto adicionado...</p>
                            @endif
                            
                            
                        </div>
                        <div class="card-footer">
                            
                            @if ($pedido->status < 2)
                                <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editar-{{$pedido->id}}">
                                    <ion-icon name="pencil-outline" title="Editar"></ion-icon>
                                </button>
                                
                                <button class="btn btn-success " data-bs-toggle="modal" data-bs-target="#add-{{$pedido->id}}">
                                    <ion-icon name="add-outline" title="Adicionar"></ion-icon>
                                </button>

                                @include('pedidos.upgrade')
                                <button class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#upgrade-{{$pedido->id}}">
                                    <ion-icon name="swap-horizontal-outline"></ion-icon>
                                </button>  
                                
                                @if ($pedido->status == 1)
                                     @include('pedidos.cancelar')
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelar-{{$pedido->id}}">
                                        <ion-icon name="close-outline" title="Cancelar"></ion-icon>
                                    </button>       
                                @else
                                    @include('pedidos.delete')
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$pedido->id}}">
                                        <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                                    </button>   
                                @endif
                                
                            @endif
                            

                            
                        </div>
                    </div>
                </div>
            @include('pedidos.edit')   
            @include('pedidos.add')   
            @endforeach

            {{$Pedidos->links()}}
        </div>
        @if (count($Pedidos) > 0)
            <hr class="mt-3 mb-3"> 
        @else
            <h5 class="mb-4 text-left h3-titulo">Você não tem nenhum pedido cadastrado.</h5>
        @endif
        
    </div>
</div>

@endsection
