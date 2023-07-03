@extends('layouts.base')

@section('head')
@endsection


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <h3 class="h3-titulo">Histórico de lançamentos financeiros
                <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#create_receita">
                    <ion-icon name="pencil-outline"></ion-icon> Nova receita
                </button>
                <button class="btn btn-danger btn-add" data-bs-toggle="modal" data-bs-target="#create_despesa">
                    <ion-icon name="pencil-outline" ></ion-icon> Nova despesa
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
        
        @include('movs_financeira.create_receita')
        @include('movs_financeira.create_despesa')
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Destinatário
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                       Valor 
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                        Ações
                    </th>
                </tr>
            </thead>
            <tbody class="bg-pink text-white divide-y divide-gray-200">
                @forelse($Movs_financeira as $movimento)
                <tr class="@if($movimento->tipo == "REC") bg-green-400 @else bg-red-400  @endif">
                    <td class="px-6 py-2 whitespace-nowrap">
                        #{{ $movimento->id }}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        @if ($movimento->id_fornecedor)
                            {{ $movimento->fornecedor->nome}}  
                        @else
                            {{ $movimento->cliente->nome }}  
                        @endif                        
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap ">
                        R${{number_format((float) $movimento->valor , 2)}}
                    </td>
                    <td class="px-6 py-2 whitespace-nowrap">
                        <a href="{{ Route('movs_financeira.destroy',['mov_Financeira' => $movimento->id])}}"><button class="btn btn-danger">
                            <ion-icon name="trash-outline" title="Excluir"></ion-icon>
                        </button></a>
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
            {{ $Movs_financeira->links() }}
        </div>
        
    </div>
</div>
@endsection