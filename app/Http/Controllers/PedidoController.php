<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Itens_Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Mov_Financeira;

class PedidoController extends Controller
{

    private function convertToValidPrice($price) {
        $price = str_replace(',', '.', $price);
        $price = trim(str_replace(['-', ',', '$','R', ' ', ' '], '', $price));
        $price = trim($price);

        if(strpos($price, '.') !== false) {
            $dollarExplode = explode('.', $price);
            $dollar = $dollarExplode[0];
            $cents = $dollarExplode[1];
            if(strlen($cents) === 0) {
                $cents = '00';
            } elseif(strlen($cents) === 1) {
                $cents = $cents.'0';
            } elseif(strlen($cents) > 2) {
                $cents = substr($cents, 0, 2);
            }
            $price = $dollar.'.'.$cents;
        } else {
            $cents = '00';
            $price = $price.'.'.$cents;
        }
        

        return $price;
    }

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
            'data_entrega' => ['date','required'],
        ]);

        $pedido = new Pedido();
        $pedido->data_criacao = Carbon::now();
        $pedido->data_entrega = $request->data_entrega;
        $pedido->id_cliente = $request->id_cliente;
        $pedido->status = 0; //Orçamento
        $pedido->save();

        return redirect( Route('home') )->with('sucess','Novo orçamento criado com sucesso!');
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
            'data_entrega' => ['date','required'],
        ]);

        $pedido->data_entrega = $request->data_entrega;
        $pedido->id_cliente = $request->id_cliente;
        if(count($pedido->itens_pedido) > 0){
            $request->validate([
                'valor_total' => ['required'],
            ]);
            $pedido->valor_total =  (float) $this->convertToValidPrice($request->valor_total); 
        }

        $pedido->save();

        $str = 'Orçamento';
        if($pedido->status == 1){
            $str = 'Pedido';
        }

        return redirect( Route('home') )->with('sucess',$str.' editado com sucesso!');
    }

    public function add(Request $request, Pedido $pedido)
    {
        $request->validate([
            'id_produto' => ['required'],
            'quantidade' => ['required','min:1'],
        ]);

        $produto = Produto::find($request->id_produto);
        $itens = new Itens_Pedido();        
        $itens->id_pedido = $pedido->id;
        $itens->id_produto = $request->id_produto;
        $itens->quantidade = $request->quantidade;

        $itens->valor = (float) $request->quantidade * $produto->preco_unitario;

        if ($pedido->status == 1) {
            $produto->estoque = $produto->estoque - $request->quantidade;
        }

        $itens->save();
        $pedido->save();
        $produto->save();

        $this->atualizarTotal($pedido,FALSE);

        $str = 'Orçamento';
        if($pedido->status == 1){
            $str = 'Pedido';
        }

        return redirect( Route('home') )->with('sucess',$str.' atualizado com sucesso!');
    }

    private function atualizarTotal(Pedido $pedido,$countEstoque)
    {
        $total = 0;
        foreach ($pedido->itens_pedido as $item) {
            $produto = $item->produto;
            if($countEstoque == TRUE){
                $produto->estoque = $produto->estoque - $item->quantidade;
            }
            $produto->save();
            $total = $total + $item->valor;
        } 
        $pedido->valor_total = $total;
        $pedido->save();    
    }

    public function upgrade(Pedido $pedido)
    {
        //0 - Orçamento
        //1- Pedido
        //2- Finalizado
        //3- Cancelado

        $msg = '';
        if($pedido->status == 0){
            $pedido->status = 1; 
            $msg = 'Pedido criado com sucesso!';
            $pedido->save();
            $this->atualizarTotal($pedido,TRUE);
        }elseif($pedido->status == 1){
            $pedido->status = 2;  
            $msg = 'Pedido finalizado com sucesso!';
            $pedido->save();

            $pedido = Pedido::find($pedido->id);
            $mov_fin = new Mov_Financeira;
            $mov_fin->id_pedido = $pedido->id;
            $mov_fin->id_cliente = $pedido->id_cliente;
            $mov_fin->tipo = 'REC';
            $mov_fin->data_limite = $pedido->data_entrega;
            $mov_fin->data_pagto = $pedido->data_finalizacao;
            $mov_fin->valor = $pedido->valor_total;
            
            $mov_fin->save();
        }          
                             
        
        return redirect( Route('home') )->with('sucess',$msg);
    }

    public function cancelar(Pedido $pedido)
    {
        //0 - Orçamento
        //1- Pedido
        //2- Finalizado
        //3- Cancelado
       
        $pedido->status = 3;       
        $pedido->save();     
        
        foreach ($pedido->itens_pedido as $item) {
            $produto = $item->produto;
            $produto->estoque = $produto->estoque + $item->quantidade;
            $produto->save();
        }
        
        return redirect( Route('home') )->with('sucess','Pedido cancelado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        if (count($pedido->itens_pedido) > 0) {
            foreach ($pedido->itens_pedido as $item) {
                $produto = Produto::find($item->id_produto);
                if ($pedido->status > 0) {
                    $produto->estoque = $produto->estoque + $item->quantidade;
                }                
                $item->delete();
                $produto->save();
            }
        }
        
        $pedido->delete();               
        
        $str = 'Orçamento';
        if($pedido->status == 1){
            $str = 'Pedido';
        }

        return redirect( Route('home') )->with('sucess',$str.' deletado com sucesso!');
    }
}
