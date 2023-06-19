<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_cliente' => function () {
                return Cliente::all()->random()->id;
            },
            'codigo_produto' => function () {
                return Produto::all()->random()->id;
            },
            'data_criacao' => $this->faker->dateTimeThisMonth(),
        ];
    }
}
