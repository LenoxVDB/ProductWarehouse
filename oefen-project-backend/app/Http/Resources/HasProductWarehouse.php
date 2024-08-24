<?php

namespace App\Http\Resources;

use App\Models\ProductWarehouse;
use Carbon\Carbon;

/** @property-read ProductWarehouse $pivot */
trait HasProductWarehouse
{
    protected function productWarehouse(): array
    {
        return [
            'pivot' => $this->whenPivotLoaded(ProductWarehouse::class, fn(): array => [
                'product_id' => $this->pivot->product_id,
                'warehouse_id' => $this->pivot->warehouse_id,
                'stock'  => $this->pivot->stock,
                $this->pivot->getCreatedAtColumn() => optional($this->pivot->{$this->pivot->getCreatedAtColumn()}, fn(Carbon $date) => $date->utc()->toIso8601String()),
                $this->pivot->getUpdatedAtColumn() => optional($this->pivot->{$this->pivot->getUpdatedAtColumn()}, fn(Carbon $date) => $date->utc()->toIso8601String()),
            ]),
        ];
    }
}
