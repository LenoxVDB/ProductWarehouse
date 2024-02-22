<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property-read Model $resource */
abstract class BaseResource extends JsonResource
{
    /** {@inheritdoc} */
    public function toArray(Request $request): array
    {
        $data = [
            $this->resource->getKeyName()         => $this->resource->getKey(),
            $this->resource->getCreatedAtColumn() => optional($this->resource->{$this->resource->getCreatedAtColumn()}, fn(Carbon $date): string => $date->utc()->toIso8601String()),
            $this->resource->getUpdatedAtColumn() => optional($this->resource->{$this->resource->getUpdatedAtColumn()}, fn(Carbon $date): string => $date->utc()->toIso8601String()),
        ];

        $traits = class_uses($this->resource);
        if (in_array(SoftDeletes::class, array_keys($traits))) {
            $data[$this->resource->getDeletedAtColumn()] = optional($this->resource->{$this->resource->getDeletedAtColumn()}, fn(Carbon $date): string => $date->utc()->toIso8601String());
        }

        return $data;

    }
}
