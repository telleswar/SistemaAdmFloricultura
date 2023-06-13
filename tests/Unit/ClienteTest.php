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
            'celular',
            'email',
            'endereco',
            'cpf',
            'cnpj'
        ];

        $arrayComp = array_diff($esperado, $cliente->getFillable());

        dd($arrayComp);

        $this->assertEquals(0, count($arrayComp));

    }
}
