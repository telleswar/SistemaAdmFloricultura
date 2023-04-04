<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class HomeController extends Controller
{
    public function index()
    {
        $Pedidos = Pedido::get();

        return view('home',compact('Pedidos'));
    }

    public function editSenha(){
        return view('auth.edit');
    }

}
