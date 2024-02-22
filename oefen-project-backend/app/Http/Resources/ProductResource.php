<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;

/** @property-read Product $resource */
class ProductResource extends BaseResource
{
    use HasProductWarehouse;

    /** {@inheritdoc} */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'summary' => $this->resource->summary,
            'warehouses' => WarehouseResource::collection($this->whenLoaded('warehouses')),
            ...$this->productWarehouse(),
        ];
    }
}
