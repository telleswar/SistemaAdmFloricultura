<?php

namespace App\Http\Controllers;

use App\Models\Mov_Financeira;
use App\Models\Cliente;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class MovFinanceiraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Movs_financeira = Mov_Financeira::orderBy('id', 'desc')->paginate(8); 
        $Clientes = Cliente::All();
        $Fornecedores = Fornecedor::All();


        return view('movs_financeira.index',compact(['Movs_financeira','Clientes','Fornecedores']));
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
    public function store_receita(Request $request)
    {
        $request->validate([
            'id_cliente' => ['required'],
            'data_limite' => ['date','required'],
            'data_pagto' => ['date','required'],
        ]);

        $mov = new Mov_Financeira;

        $mov->id_cliente = $request->id_cliente;
        $mov->valor = (float) $this->convertToValidPrice($request->valor);
        $mov->tipo = "REC";
        $mov->data_limite = $request->data_limite;
        $mov->data_pagto = $request->data_pagto; 
        
        $mov->save();
        return redirect( Route('movs_financeira.index') )->with('sucess','Novo lançamento financeiro cadastrado com sucesso!');
    }

    public function store_despesa(Request $request)
    {
        $request->validate([
            'id_fornecedor' => ['required'],
            'data_limite' => ['date','required'],
            'data_pagto' => ['date','required'],
        ]);

        $mov = new Mov_Financeira;

        $mov->id_fornecedor = $request->id_fornecedor;
        $mov->valor = (float) $this->convertToValidPrice($request->valor);
        $mov->tipo = "DESP";
        $mov->data_limite = $request->data_limite;
        $mov->data_pagto = $request->data_pagto; 
        
        $mov->save();
        return redirect( Route('movs_financeira.index') )->with('sucess','Novo lançamento financeiro cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mov_Financeira  $mov_Financeira
     * @return \Illuminate\Http\Response
     */
    public function show(Mov_Financeira $mov_Financeira)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mov_Financeira  $mov_Financeira
     * @return \Illuminate\Http\Response
     */
    public function edit(Mov_Financeira $mov_Financeira)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mov_Financeira  $mov_Financeira
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mov_Financeira $mov_Financeira)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mov_Financeira  $mov_Financeira
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mov_Financeira $mov_Financeira)
    {
        $mov_Financeira->delete();
        return redirect(Route('movs_financeira.index'))->with('sucess','Lançamento financeiro deletado com sucesso!');
    }

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
}
