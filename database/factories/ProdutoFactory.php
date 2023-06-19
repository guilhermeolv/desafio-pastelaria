<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    protected $model = Produto::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'  => $this->faker->name,
            'preco' => $this->faker->numberBetween($min = 4, $max = 15),
            'foto'  => $this->faker->imageUrl($width = 200, $height = 200)
        ];
    }
}
