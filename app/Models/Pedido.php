<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';
    public $timestamps = false;

    protected $dates = ['data_criacao','data_entrega','data_finalizacao','data_upgrade'];

    protected $fillable = [
        'numero',
        'valor_total',
        'data_criacao',
        'data_entrega',
        'status',
        'data_finalizacao',
        'data_upgrade'
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

    public function itens_pedido()
    {
        return $this->hasMany(Itens_Pedido::class,'id_pedido');
    }

}

