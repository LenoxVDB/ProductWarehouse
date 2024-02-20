<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResponse
    {
        $warehouse = Warehouse::with([
            'products',
        ])
            ->get();

        return response()
            ->json($warehouse);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWarehouseRequest $request): JsonResponse
    {
        $warehouse = Warehouse::create($request->validated());
        return response()->json($warehouse);
    }

    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse): JsonResponse
    {
        return response()->json($warehouse->load('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
