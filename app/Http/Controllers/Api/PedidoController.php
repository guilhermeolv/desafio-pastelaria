<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Http\Resources\PedidoCollection;
use App\Http\Resources\PedidoResource;
use App\Models\Pedido;
use Illuminate\Http\JsonResponse;

class PedidoController extends Controller
{

    protected $pedido;
    protected $pedidoCollection;

    public function __construct(
        PedidoCollection $pedidoCollection,
        Pedido $pedido
    ) {
        $this->pedidoCollection = $pedidoCollection;
        $this->pedido = $pedido;
    }

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
        return response()->json(
            $this->pedidoCollection->make($this->pedido->create($request->all())),
            201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $pedido): JsonResponse
    {
        return response()->json(
            $this->pedidoCollection->make($this->pedido->query()->findOrFail($pedido))
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
        $this->pedido->delete($pedido);
        return;
    }
}
