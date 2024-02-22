<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warehouse::factory()
            ->count(5)
            ->hasAttached(Product::factory()
            ->count(fake()->numberBetween(3, 10)), [
                'stock' => fake()->numberBetween(1, 20),
            ])
            ->create();
    }
}
