<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Pedido;

class PedidoTest extends TestCase
{
    /** @test*/
    public function verificar_pedido_colunas_banco()
    {
        $pedido = new Pedido;
        
        $esperado = [
            'numero',
            'valor_total',
            'data_criacao',
            'data_entrega'
        ];

        $arrayComp = array_diff($esperado, $pedido->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}