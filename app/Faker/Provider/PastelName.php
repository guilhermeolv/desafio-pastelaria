<?php

namespace App\Faker\Provider;

use Faker\Provider\Base;

class PastelName extends Base
{
    protected static $nome = [
        'Carne',
        'Queijo',
        'Frango',
        'Pizza',
        'Calabresa'
    ];

    public function pastelName(): string
    {
        return static::randomElement(static::$nome);
    }
}