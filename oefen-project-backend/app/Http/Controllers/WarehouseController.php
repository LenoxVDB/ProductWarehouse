<?php

namespace App\Http\Controllers;

use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use GuzzleHttp\Psr7\Request;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    public function index():JsonResponse
    {
        $warehouses = Warehouse::with([
            'products',
        ])
            ->get();

        return WarehouseResource::collection($warehouses)
            ->response();
    }

    public function store(StoreWarehouseRequest $request): JsonResponse
    {
        $warehouse = Warehouse::create($request->validated());

        return (new WarehouseResource($warehouse))
            ->response();
    }

    public function show(Warehouse $warehouse): JsonResponse
    {
        $warehouse->load([
            'products',
        ]);

        return (new WarehouseResource($warehouse))
            ->response();
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->validated());

        return (new WarehouseResource($warehouse))
            ->response();
    }

    public function destroy(Warehouse $warehouse): JsonResponse
    {
        $warehouse->delete();

        return response()->json();
    }
}
