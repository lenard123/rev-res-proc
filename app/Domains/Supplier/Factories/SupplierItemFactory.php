<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierItemFactory extends Factory
{
    protected $model = SupplierItem::class;

    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::factory(),
            'item_id' => Item::factory(),
            'status' => SupplierItem::STATUS_ACTIVE,
            'notes' => fake()->paragraph(1),
        ];
    }
}