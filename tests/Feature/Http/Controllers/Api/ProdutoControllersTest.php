<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Produto;
use Database\Factories\ProdutoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoControllersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->route = "api/produtos";

        $this->produto = Produto::create([
            'nome'  => 'Pastel de frango',
            'preco' => '4.99',
            'foto'  => 'asdasdhdashasdh.jpeg',
        ]);

        $this->modelClass = Produto::class;
        $this->produtoFactory = new ProdutoFactory();
    }

    public function testGetProdutoEndpoint(): void
    {
        $response = $this->get($this->route);
        $response->assertStatus(200);
    }

    public function testFactoryStoreProduto(): void
    {
        Produto::factory(5)->create();
        $response = $this->getJson($this->route);
        $response->assertStatus(200);
        $response->assertJsonCount(5, '0.data');
    }

    public function testpostStoreProduto(): void
    {
        $response = $this->post($this->route, [
            'nome'  => 'Pastel de frango',
            'preco' => '4.99',
            'foto'  => 'asdasdhdashasdh.jpeg',
        ]);
        $response->assertStatus(200);

    }

    // public function testStoreProdutoEndpoint(): void
    // {
    //     $response = $this->post($this->route, [
    //         'nome'  => $this->faker->name,
    //         'preco' => $this->faker->numberBetween($min = 4, $max = 15),
    //         'foto'  => $this->faker->imageUrl($width = 200, $height = 200)
    //     ]);
    //     $response->assertStatus(201);
    // }

    // public function testShow(): void
    // {
    //     
    // }
}
