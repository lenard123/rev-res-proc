<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierItemOfferFactory extends Factory
{
    protected $model = SupplierItemOffer::class;

    public function definition()
    {
        return [
            'supplier_item_id' => SupplierItem::factory(),
            'uom_id' => 1,
            'last_quoted_price' => 250,
            'is_default' => 1,
            'status' => SupplierItemOffer::STATUS_ACTIVE,
            'currency' => 'PHP',
            'conversion_factor_to_item_uom' => 1,
        ];
    }

    public function forItem(Item $item)
    {
        return $this->state([
            'supplier_item_id' => SupplierItem::factory()->for($item)
        ]);
    }
}