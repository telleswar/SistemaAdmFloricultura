<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';
    public $timestamps = false;

    protected $fillable = [
        'numero',
        'valor_total',
        'data_criacao',
        'data_entrega',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }

}

