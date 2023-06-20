<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'data_nascimento',
        'endereco',
        'complemento',
        'bairro',
        'cep',
        'data_cadastro'
    ];

    public static $rules = [
        'nome'              => 'required|string|max:255',
        'email'             => 'required|email|unique:clientes',
        'telefone'          => 'required|string|max:20',
        'data_nascimento'   => 'required|date',
        'endereco'          => 'required|string|max:255',
        'complemento'       => 'nullable|string|max:255',
        'bairro'            => 'required|string|max:255',
        'cep'               => 'required|string|max:10',
        'data_cadastro'     => 'required|date'
    ];
    
    
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'codigo_cliente', 'id');
    }
}
