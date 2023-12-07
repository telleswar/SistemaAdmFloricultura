<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $Pedidos = Pedido::orderBy('data_criacao', 'desc')->paginate(8);
        $Clientes = Cliente::All();
        $Produtos = Produto::All();

        return view('home',compact(['Pedidos','Clientes','Produtos']));
    }

    public function auth_edit(){
        return view('auth.edit');
    }

    public function auth_update(Request $request){
        
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->update();

        // dd($user);
        
        return redirect( Route('auth.edit'))->with('sucess','Senha alterada com sucesso!');
    }

}
