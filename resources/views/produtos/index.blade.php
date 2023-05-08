@extends('layouts.base')

@section('head')
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Lista de produtos
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    <ion-icon name="bag-add-outline"></ion-icon> Novo produto
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

        @include('produtos.create')

        <div id="lista-produtos" class="row text-center font-sans">
            @foreach ($Produtos as $produto) 
                <div class="col-xl-3 col-xs-4 col-lg-4 col-md-6 col-sm-12 col-12 d-flex ms-sm-0 ms-2 align-items-stretch justify-content-center ">
                    <div class="card bg-dark">
                        <div class="card-header md:flex md:text-left">
                            <div class="flex flex-wrap">
                                <h1 class="flex-auto text-lg font-semibold text-slate-900">
                                    @if ($produto->imagem)
                                        <img id="imagem-produto" src="img/produtos/{{$produto->imagem}}" alt="{{$produto->nome}}" class="w-10 h-10 rounded-full">
                                    @else
                                        <ion-icon name="bag-outline"></ion-icon>
                                    @endif
                                </h1>
                                <div class="text-lg font-semibold text-white">
                                    {{$produto->nome}}
                                </div>
                                <div class="w-full flex-none text-sm font-medium text-white mt-2">
                                    Id: #{{$produto->id}}
                                </div>
                              </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><ion-icon name="bookmark-outline"></ion-icon>Tipo: {{$produto->tipo}}</p>
                            <p class="card-text"><ion-icon name="pricetag-outline"></ion-icon>Custo: R${{number_format((float) $produto->custo, 2)}}</p>
                            <p class="card-text"><ion-icon name="pricetags-outline"></ion-icon>Preço unitário: R${{number_format((float) $produto->preco_unitario, 2)}}</p>
                            <p class="card-text"><ion-icon name="cube-outline"></ion-icon>Estoque: {{$produto->estoque}}</p>
                            <p class="card-text"><ion-icon name="chatbox-outline"></ion-icon>Descrição: {{$produto->descricao}}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#editar-{{$produto->id}}">
                                <ion-icon name="pencil-outline" title="Editar"></ion-icon>
                            </button>
                            
                            <a href="{{ Route('produtos.destroy',['produto' => $produto->id])}}"><button class="btn btn-danger">
                                <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                            </button></a>
                        </div>
                    </div>
                </div>
                @include('produtos.edit')
            @endforeach
            {{$Produtos->links()}}
        </div>
       
        <hr class="mt-3 mb-3">
    </div>
</div>
@endsection
