<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    /** @inheritdoc */
    protected $fillable = [
        'name',
        'price',
        'summary',
    ];

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class)
            ->using(ProductWarehouse::class)
            ->withPivot(ProductWarehouse::$pivotColumns)
            ->withTimestamps()
            ->as(ProductWarehouse::$pivotName);
    }
}
