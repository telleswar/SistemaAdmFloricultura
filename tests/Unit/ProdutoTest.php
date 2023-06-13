<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Produto;

class ProdutoTest extends TestCase
{
    /** @test*/
    public function verificar_produto_colunas_banco()
    {
        $Produto = new Produto;
        
        $esperado = [
            'id',
            'nome',
            'custo',
            'tipo',
            'descricao',
            'preco_unitario',
            'estoque',
            'imagem'
        ];

        $arrayComp = array_diff($esperado, $Produto->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}