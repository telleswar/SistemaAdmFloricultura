<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itens_Pedido extends Model
{
    use HasFactory;

    protected $table = 'itens_pedido';
    public $timestamps = false;

    protected $fillable = [
        'quantidade',
        'valor',
    ];

    public function pedido(){
        return $this->belongsTo(Pedido::class,'id_pedido');
    }

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto');
    }
}
