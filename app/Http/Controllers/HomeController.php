<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $Pedidos = Pedido::paginate(8);

        return view('home',compact('Pedidos'));
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
