<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Cliente;

class ClientTest extends TestCase
{
    /** @test*/
    public function verificar_cliente_colunas_banco()
    {
        $cliente = new Cliente;
        
        $esperado = [
            'id',
            'nome',
            'telefone',
            'email',
            'endereco',
            'cpf',
            'cnpj'
        ];

        $arrayComp = array_diff($esperado, $cliente->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}
