<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Mov_Estoque;

class PedidoTest extends TestCase
{
    /** @test*/
    public function verificar_pedido_colunas_banco()
    {
        $Pedido = new Pedido;
        
        $esperado = [
            'numero',
            'valor_total',
            'data_criacao',
            'data_entrega'
        ];

        $arrayComp = array_diff($esperado, $Pedido->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}