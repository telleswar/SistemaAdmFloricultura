@extends('layouts.base')

@section('head')
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Histórico de lançamentos de estoque
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create">
                    <ion-icon name="pencil-outline"></ion-icon> Novo lançamento
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
        
        @include('movs_estoque.create')
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Fornecedor
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Produto
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Quantidade
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Data
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-pink text-white divide-y divide-gray-200">
                @forelse($Movs_estoque as $movimento)
                <tr>
                    <td class="px-6 py-2 whitespace-nowrap">
                        {{ $movimento->id }}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        {{ $movimento->fornecedor->nome}}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        {{ $movimento->produto->nome }}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        {{ $movimento->quantidade }}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($movimento->data)->format('d/m/Y')}}
                    </td>
                    @include('movs_estoque.delete')
                    <td class="px-6 py-2 whitespace-nowrap">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-{{$movimento->id}}">
                            <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                        </button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td class="px-6 py-2 whitespace-nowrap" colspan="6">
                            Nenhum registro encontrado...
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $Movs_estoque->links() }}
        </div>
        
    </div>
</div>
@endsection