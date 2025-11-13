<?php

namespace App\Domains\Supplier\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use App\Domains\Supplier\Models\SupplierItemOfferPrice;
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
            'is_default' => false,
            'status' => SupplierItemOffer::STATUS_ACTIVE,
            'currency' => 'PHP',
            'conversion_factor_to_item_uom' => 1,
        ];
    }

    public function default()
    {
        return $this->state(['is_default' => true]);
    }

    public function forItem(Item $item)
    {
        return $this->state([
            'supplier_item_id' => SupplierItem::factory()->for($item)
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (SupplierItemOffer $offer) {
            if ($offer->prices()->count() == 0) {
                SupplierItemOfferPrice::factory()
                    ->for($offer, 'offer')
                    ->create([
                        'unit_price' => $offer->last_quoted_price,
                        'valid_from' => now(),
                        'notes' => 'AUTO GENERATED FROM FACTORY',
                    ]);
            }
        });
    }
}