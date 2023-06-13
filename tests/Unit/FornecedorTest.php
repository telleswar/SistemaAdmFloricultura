<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Fornecedor;

class FornecedorTest extends TestCase
{
    /** @test*/
    public function verificar_fornecedor_colunas_banco()
    {
        $fornecedor = new Fornecedor;
        
        $esperado = [
            'id',
            'nome',
            'telefone',
            'email',
            'endereco',
            'cnpj'  
        ];

        $arrayComp = array_diff($esperado, $fornecedor->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}
