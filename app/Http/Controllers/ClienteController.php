<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(){
        $Clientes = Cliente::paginate(8);

        return view('clientes.index',compact('Clientes'));
    }

    public function destroy(Cliente $cliente){
        $cliente->delete();
        return redirect(Route('clientes.index'))->with('sucess','Cliente deletado com sucesso!');
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
            'nome' => ['required','string','min:5','max:120'],
            'email' => ['required','string','min:5','max:120','email'],
            'telefone' => ['required','celular_com_ddd'],
            'endereco' => ['required','string','min:8','max:120'],
            'cpf' => ['required','formato_cpf'],
        ]);


        $cliente = new Cliente();
        $cliente->id = $request->id;
        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->endereco = $request->endereco;
        $cliente->save();

        return redirect( Route('clientes.index') )->with('sucess','Novo cliente cadastrado com sucesso!');
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
        $request->validate([
            'nome' => ['required','string','min:5','max:120'],
            'email' => ['required','string','min:5','max:120','email'],
            'telefone' => ['required','celular_com_ddd'],
            'endereco' => ['required','string','min:8','max:120'],
            'cpf' => ['required','formato_cpf'],
        ]);

        $cliente->nome = $request->nome;
        $cliente->cpf = $request->cpf;
        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->endereco = $request->endereco;
        $cliente->save();

        return redirect( Route('clientes.index') )->with('sucess','Cliente alterado com sucesso!');
    }
}
