<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductWarehousePivotRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\WarehouseResource;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\JsonResponse;

class ProductWarehouseController extends Controller
{
    public function index(Product $product): JsonResponse
    {
        $warehouses = $product->warehouses()
            ->get();

        return WarehouseResource::collection($warehouses)
            ->response();
    }

    public function store(Product $product, Warehouse $warehouse, ProductWarehousePivotRequest $request): JsonResponse
    {
        $product->warehouses()
            ->attach([
                $warehouse->getKey() => $request->validated()
            ]);

        $warehouse->load([
            'products'
        ]);

        return ProductResource::make($product)
            ->response();
    }

    public function update(Product $product, Warehouse $warehouse, ProductWarehousePivotRequest $request): JsonResponse
    {
        $product->warehouses()
            ->syncWithoutDetaching([
                $warehouse->getKey() => $request->validated()
            ]);

        $product->load([
            'warehouses'
        ]);

        return ProductResource::make($product)
            ->response();
    }
}
