<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Itens_Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'id_cliente' => ['required'],
            'id_produto' => ['required'],
            'quantidade' => ['required','min:1'],
            'data_entrega' => ['date','required'],
        ]);

        $pedido = new Pedido();
        $pedido->data_criacao = Carbon::now();
        $pedido->data_entrega = $request->data_entrega;
        $pedido->id_cliente = $request->id_cliente;
        $pedido->save();

        $produto = Produto::find($request->id_produto);

        $itens = new Itens_Pedido();
        $itens->id_pedido = $pedido->id;
        $itens->id_produto = $request->id_produto;
        $itens->quantidade = $request->quantidade;

        $itens->valor = (float) $request->quantidade * $produto->preco_unitario;
        $pedido->valor_total = (float) $itens->valor;
        $produto->estoque = $produto->estoque - $request->quantidade;

        $itens->save();
        $pedido->save();
        $produto->save();

        return redirect( Route('home') )->with('sucess','Novo pedido cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        return view('Pedido.show',compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_cliente' => ['required'],
            'id_produto' => ['required'],
            'quantidade' => ['required','min:1'],
            'data_entrega' => ['date','required'],
        ]);

        $pedido->data_entrega = $request->data_entrega;
        $pedido->id_cliente = $request->id_cliente;

        $produto = Produto::find($pedido->itens_pedido[0]->produto->id);
        $produto->estoque = $produto->estoque + $pedido->itens_pedido[0]->quantidade;
        $pedido->itens_pedido[0]->delete();
        $produto->save();

        $produto = Produto::find($request->id_produto);
        $itens = new Itens_Pedido();        
        $itens->id_pedido = $pedido->id;
        $itens->id_produto = $request->id_produto;
        $itens->quantidade = $request->quantidade;

        $itens->valor = (float) $request->quantidade * $produto->preco_unitario;
        $pedido->valor_total = (float) $itens->valor;
        $produto->estoque = $produto->estoque - $request->quantidade;

        $itens->save();
        $pedido->save();
        $produto->save();

        return redirect( Route('home') )->with('sucess','Pedido editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        $produto = Produto::find($pedido->itens_pedido[0]->id_produto);
        $produto->estoque = $produto->estoque + $pedido->itens_pedido[0]->quantidade;
        $pedido->itens_pedido[0]->delete();
        $pedido->delete();
        $produto->save();
        return redirect(Route('home'))->with('sucess','Pedido deletado com sucesso!');
    }
}
