<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nome',
        'custo',
        'tipo',
        'descricao',
        'preco_unitario',
        'estoque',
        'imagem'
    ];

}
