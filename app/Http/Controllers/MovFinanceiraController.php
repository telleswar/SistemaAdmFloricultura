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
        $Movs_financeira = Mov_Financeira::paginate(8);
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
