<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nome',
        'telefone',
        'email',
        'endereco',
        'cpf',
        'cnpj',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class,'id_cliente');
    }
}
