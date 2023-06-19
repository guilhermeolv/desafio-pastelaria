<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoCollection;
use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\JsonResponse;

class ProdutoController extends Controller
{
    protected $produto;
    protected $produtoCollection;

    public function __construct(
        ProdutoCollection $produtoCollection,
        Produto $produto
    ) {
        $this->produtoCollection = $produtoCollection;
        $this->produto = $produto;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = $this->produto->query();
        $produto = $query->paginate(5);
        $produtoListResource = new produtoCollection($produto);

        return response()->json(
            $produtoListResource
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $request): JsonResponse
    {
        return response()->json(
            $this->produtoCollection->make($this->produto->create($request->all())),
            201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $produto): JsonResponse
    {
        return response()->json(
            $this->produtoCollection->make($this->produto->query()->findOrFail($produto))
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $produto
     * @param  UpdateProdutoRequest  $request
     * @return JsonResponse
     */
    public function update(int $produto, UpdateProdutoRequest $request): JsonResponse
    {
        $this->produto->query()->find($produto)->update($request->all());

        return response()->json(
            ProdutoResource::make(
                $this->produto->query()->findOrFail($produto)
            ),
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $produto)
    {
        $this->produto->delete($produto);
        return;
    }
}
