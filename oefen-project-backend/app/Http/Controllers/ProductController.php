<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::with([
            'warehouses',
        ])
            ->get();

        return ProductResource::collection($products)
            ->response();
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->response();
    }

    public function show(Product $product): JsonResponse
    {
        $product->load([
            'warehouses',
        ]);

        return (new ProductResource($product))
            ->response();
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return (new ProductResource($product))
            ->response();
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json();
    }
}
