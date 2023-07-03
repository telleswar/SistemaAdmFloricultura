<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mov_Financeira extends Model
{
    use HasFactory;

    protected $table = 'mov_financeira';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'valor',
        'tipo',
        'data_limite',
        'data_pagto',
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class,'id_fornecedor');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
