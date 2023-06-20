<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Http\Resources\PedidoCollection;
use App\Http\Resources\PedidoResource;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class PedidoController extends Controller
{

    protected $pedido;
    protected $pedidoCollection;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->pedido->query();
        $pedido = $query->paginate(5);
        $pedidoListResource = new pedidoCollection($pedido);

        return response()->json(
            $pedidoListResource
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request): JsonResponse
    {
        $pedido = new Pedido();
        $pedido->codigo_cliente = $request->codigo_cliente;
        $pedido->codigo_produto = $request->codigo_produto;
        $pedido->data_criacao = $request->data_criacao;
        $pedido->save();

        $reponse = PedidoResource::make(Pedido::create($request->all()));

        if ($reponse == 201) {
            Mail::send('Html.view', $pedido, function ($message) {
                $message->from('john@johndoe.com', 'John Doe');
                $message->sender('john@johndoe.com', 'John Doe');
                $message->subject('Subject');
                $message->priority(3);
                $message->attach('pathToFile');
            });
        }
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $pedido): JsonResponse
    {
        return response()->json(
            PedidoCollection::make($this->pedido->query()->findOrFail($pedido))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $pedido
     * @param  UpdatePedidoRequest  $request
     * @return JsonResponse
     */
    public function update(int $pedido, UpdatePedidoRequest $request): JsonResponse
    {
        $this->pedido->query()->find($pedido)->update($request->all());

        return response()->json(
            PedidoResource::make(
                $this->pedido->query()->findOrFail($pedido)
            ),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $pedido)
    {
        return response()->json(Pedido::destroy($pedido), 202);
    }
}
