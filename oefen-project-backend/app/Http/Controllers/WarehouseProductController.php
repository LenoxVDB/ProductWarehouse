<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductWarehousePivotRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;

class WarehouseProductController extends Controller
{
    public function index(Warehouse $warehouse): JsonResponse
    {
        $products = $warehouse->products()
            ->get();

        return ProductResource::collection($products)
            ->response();
    }

    public function store(Warehouse $warehouse, Product $product, ProductWarehousePivotRequest $request): JsonResponse
    {
        $warehouse->products()
            ->attach([
                $product->getKey() => $request->validated()
            ]);

        $warehouse->load([
            'products'
        ]);

        return WarehouseResource::make($warehouse)
            ->response();
    }

    public function update(Warehouse $warehouse, Product $product, ProductWarehousePivotRequest $request): JsonResponse
    {
        $warehouse->products()
            ->syncWithoutDetaching([
                $warehouse->getKey() => $request->validated()
            ]);

        $warehouse->load([
            'products'
        ]);

        return WarehouseResource::make($warehouse)
            ->response();
    }
}
