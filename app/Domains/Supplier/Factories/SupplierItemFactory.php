<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Summary of SupplierItemFactory
 * @extends Factory<SupplierItem>
 */
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

    public function withDefaultOffer()
    {
        return $this->afterCreating(function(SupplierItem $supplierItem) {
            if ($supplierItem->offers()->count() === 0) {
                $item_uom_id = $supplierItem->item->base_uom_id;
                SupplierItemOffer::factory()
                    ->for($supplierItem)
                    ->default()
                    ->create([
                        'uom_id' => $item_uom_id
                    ]);
            }
        });
    }
}