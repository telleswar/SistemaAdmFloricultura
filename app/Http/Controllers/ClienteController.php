<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $Clientes = Cliente::get();

        return view('clientes.index',compact('Clientes'));
    }

    public function destroy(Cliente $cliente){
        $cliente->delete();
        return redirect(Route('clientes.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->id = $request->id;
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->endereco = $request->endereco;
        $cliente->save();

        return redirect( Route('clientes.index') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->endereco = $request->endereco;
        $cliente->save();

        return redirect( Route('clientes.index') );
    }
}
