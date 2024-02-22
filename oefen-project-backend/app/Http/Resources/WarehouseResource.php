<?php

namespace App\Http\Resources;

use App\Models\Warehouse;
use Illuminate\Http\Request;

/** @property-read Warehouse $resource */
class WarehouseResource extends BaseResource
{
    use HasProductWarehouse;

    /** {@inheritdoc} */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'name' => $this->resource->name,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            ...$this->productWarehouse(),
        ];
    }
}
