<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use App\Models\Cliente;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;

class ClienteController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Cliente::query();
        $cliente = $query->paginate(5);
        $clienteListResource = new ClienteCollection($cliente);

        return response()->json(
            $clienteListResource
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): JsonResponse
    {
        return response()->json(
            ClienteResource::make(Cliente::create($request->all())),
            201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $cliente): JsonResponse
    {
        return response()->json(
            ClienteResource::make(Cliente::query()->findOrFail($cliente))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $cliente
     * @param  UpdateClienteRequest  $request
     * @return JsonResponse
     */
    public function update(int $cliente, UpdateClienteRequest $request): JsonResponse
    {
        Cliente::query()->find($cliente)->update($request->all());

        return response()->json(
            ClienteResource::make(
                Cliente::query()->findOrFail($cliente)
            ),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $cliente
     * @return Response
     */
    public function destroy(int $cliente)
    {
        return response()->json(Cliente::destroy($cliente), 202);
    }
}
