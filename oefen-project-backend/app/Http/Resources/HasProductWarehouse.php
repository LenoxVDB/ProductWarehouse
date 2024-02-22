<?php

namespace App\Http\Resources;

use App\Models\ProductWarehouse;
use Carbon\Carbon;

/** @property-read ProductWarehouse $productWarehouse */
trait HasProductWarehouse
{
    protected function productWarehouse(): array
    {
        return [
            ProductWarehouse::$pivotName => $this->whenPivotLoadedAs(ProductWarehouse::$pivotName, (new ProductWarehouse)->getTable(), fn(): array => [
                'product_id' => $this->productWarehouse->product_id,
                'warehouse_id' => $this->productWarehouse->warehouse_id,
                'stock'  => $this->productWarehouse->stock,
                $this->productWarehouse->getCreatedAtColumn() => optional($this->productWarehouse->{$this->productWarehouse->getCreatedAtColumn()}, fn(Carbon $date) => $date->utc()->toIso8601String()),
                $this->productWarehouse->getUpdatedAtColumn() => optional($this->productWarehouse->{$this->productWarehouse->getUpdatedAtColumn()}, fn(Carbon $date) => $date->utc()->toIso8601String()),
            ]),
        ];
    }
}
