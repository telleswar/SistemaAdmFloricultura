<?php

namespace App\Http\Controllers;

use App\Models\Mov_Estoque;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MovEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Movs_estoque = Mov_Estoque::paginate(8);
        $Produtos = Produto::All();
        $Fornecedores = Fornecedor::All();

        return view('movs_estoque.index',compact(['Movs_estoque','Produtos','Fornecedores']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_fornecedor' => ['required'],
            'id_produto' => ['required'],
            'quantidade' => ['required','min:1'],
            'data' => ['date'],
        ]);

        $mov_estoque = new Mov_Estoque();
        $mov_estoque->id_fornecedor = $request->id_fornecedor;
        $mov_estoque->id_produto = $request->id_produto;
        $mov_estoque->quantidade = $request->quantidade; 
        if($request->data){
            $mov_estoque->data = $request->data;
        }
        $mov_estoque->save();

        $produto = Produto::find($mov_estoque->id_produto);
        $produto->estoque = $produto->estoque + $mov_estoque->quantidade;
        $produto->save();

        return redirect( Route('movs_estoque.index') )->with('sucess','Novo lançamento de estoque cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mov_Estoque  $mov_Estoque
     * @return \Illuminate\Http\Response
     */
    public function show(Mov_Estoque $mov_Estoque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mov_Estoque  $mov_Estoque
     * @return \Illuminate\Http\Response
     */
    public function edit(Mov_Estoque $mov_Estoque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mov_Estoque  $mov_Estoque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mov_Estoque $mov_Estoque)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mov_Estoque  $mov_Estoque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mov_Estoque $mov_Estoque)
    {
        $produto = Produto::find($mov_Estoque->id_produto);
        $produto->estoque = $produto->estoque - $mov_Estoque->quantidade;
        $mov_Estoque->delete();
        $produto->save();
        return redirect(Route('movs_estoque.index'))->with('sucess','Lançamento de estoque deletado com sucesso!');
    }
}
