<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class HomeController extends Controller
{
    public function index()
    {
        $Pedidos = Pedido::paginate(6);

        return view('home',compact('Pedidos'));
    }

    public function auth_edit(){
        return view('auth.edit');
    }

    public function auth_update(){
        return view('auth.edit');
    }

}
