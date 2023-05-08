<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdutoController extends Controller
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
        $Produtos = Produto::paginate(6);

        return view('produtos.index',compact('Produtos'));
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

        // dd($this->convertToValidPrice($request->preco_unitario));

        // $request->validate([
        //     'nome' => ['required','string','min:5','max:120'],
        //     'tipo' => ['required','string','min:5','max:120'],
        // ]);

        $produto = new Produto();

        $produto->nome = $request->nome;
        $produto->tipo = $request->tipo;        
        $produto->preco_unitario = (float) $this->convertToValidPrice($request->preco_unitario);          
        $produto->custo = (float) $this->convertToValidPrice($request->custo);
        $produto->descricao = $request->descricao;
        $produto->estoque = 0;
        $produto->id_fornecedor = 1;

        $produto->save();

        return redirect( Route('produtos.index') )->with('sucess','Novo produto cadastrado com sucesso!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {

        
        $request->validate([
            'nome' => ['required','string','min:5','max:120'],
            'tipo' => ['required','string','min:5','max:120'],
        ]);

        $produto->nome = $request->nome;
        $produto->tipo = $request->tipo;        
        $produto->preco_unitario = (float) $this->convertToValidPrice($request->preco_unitario);          
        $produto->custo = (float) $this->convertToValidPrice($request->custo);
        $produto->descricao = $request->descricao;
        $produto->estoque = 0;
        $produto->id_fornecedor = 1;

        $produto->save();

        return redirect( Route('produtos.index') )->with('sucess','Produto alterado com sucesso!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect(Route('produtos.index'))->with('sucess','Produto deletado com sucesso!');
    }
}