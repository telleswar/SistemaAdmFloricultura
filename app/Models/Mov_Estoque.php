<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mov_Estoque extends Model
{
    use HasFactory;

    protected $table = 'mov_estoque';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'quantidade',
        'data',
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class,'id_fornecedor');
    }

    public function produto(){
        return $this->belongsTo(Produto::class,'id_produto');
    }
}
