<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test*/
    public function verificar_user_colunas_banco()
    {
        $User = new User;
        
        $esperado = [
            'name',
            'email',
            'password'
        ];

        $arrayComp = array_diff($esperado, $User->getFillable());

        $this->assertEquals(0, count($arrayComp));

    }
}