<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Fornecedores = Fornecedor::paginate(8);

        return view('fornecedores.index',compact('Fornecedores'));
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
            'nome' => ['required','string','min:5','max:120'],
            'email' => ['required','string','min:5','max:120','email'],
            'telefone' => ['required','celular_com_ddd'],
            'endereco' => ['required','string','min:8','max:120'],
            'cnpj' => ['required','formato_cnpj'],
        ]);


        $fornecedor = new Fornecedor();
        $fornecedor->id = $request->id;
        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->email = $request->email;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->save();

        return redirect( Route('fornecedores.index') )->with('sucess','Novo fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function show(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $request->validate([
            'nome' => ['required','string','min:5','max:120'],
            'email' => ['required','string','min:5','max:120','email'],
            'telefone' => ['required','celular_com_ddd'],
            'endereco' => ['required','string','min:8','max:120'],
            'cnpj' => ['required','formato_cnpj'],
        ]);

        $fornecedor->nome = $request->nome;
        $fornecedor->cnpj = $request->cnpj;
        $fornecedor->email = $request->email;
        $fornecedor->telefone = $request->telefone;
        $fornecedor->endereco = $request->endereco;
        $fornecedor->save();

        return redirect( Route('fornecedores.index') )->with('sucess','Fornecedor alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fornecedor  $fornecedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();
        return redirect(Route('fornecedores.index'))->with('sucess','Fornecedor deletado com sucesso!');
    }
}
