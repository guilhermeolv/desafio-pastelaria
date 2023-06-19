<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ProdutoFactory;

class Produto extends Model
{
    use HasFactory;
    protected $factory = ProdutoFactory::class;

    protected $fillable = [
        'nome',
        'preco',
        'foto'
    ];

    public static $rules = [
        'nome'  => 'required|string|max:255',
        'preco' => 'required|numeric|decimal:2',
        'foto'  => 'required|file|mimes:jpg,bmp,png|max:1024',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'codigo_produto', 'id');
    }
}
