<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;

class ClienteController extends Controller
{

    protected $clienteCollection;
    protected $cliente;

    public function __construct(
        ClienteCollection $clienteCollection,
        Cliente $cliente
    ) {
        $this->clienteCollection = $clienteCollection;
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->cliente->query();
        $clientes = $query->paginate(5);
        $clientesListResource = new ClienteCollection($clientes);

        return response()->json(
            $clientesListResource
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): JsonResponse
    {
        return response()->json(
            $this->clienteCollection->make($this->cliente->create($request->all())),
            201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $clientes): JsonResponse
    {
        return response()->json(
            $this->clienteCollection->make($this->cliente->query()->findOrFail($clientes))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $clientes
     * @param  UpdateClienteRequest  $request
     * @return JsonResponse
     */
    public function update(int $clientes, UpdateClienteRequest $request): JsonResponse
    {
        $this->cliente->query()->find($clientes)->update($request->all());

        return response()->json(
            ClienteResource::make(
                $this->cliente->query()->findOrFail($clientes)
            ),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $clientes
     * @return Response
     */
    public function destroy(int $clientes)
    {
        $this->cliente->delete($clientes);
        return;
    }
}
