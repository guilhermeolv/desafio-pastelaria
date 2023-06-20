<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'codigo_cliente',
        'codigo_produto',
        'data_criacao'
    ];

    public static $rules = [
        'codigo_do_cliente' => 'required|exists:clientes,id',
        'codigo_do_produto' => 'required|exists:produtos,id',
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'codigo_cliente', 'id');
    }
}
