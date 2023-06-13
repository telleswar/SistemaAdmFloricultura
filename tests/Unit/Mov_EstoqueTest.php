<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Mov_Estoque;

class Mov_EstoqueTest extends TestCase
{
    /** @test*/
    public function verificar_mov_estoque_colunas_banco()
    {
        $Mov_Estoque = new Mov_Estoque;
        
        $esperado = [
            'id',
            'quantidade',
            'data'  
        ];

        $arrayComp = array_diff($esperado, $Mov_Estoque->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}
