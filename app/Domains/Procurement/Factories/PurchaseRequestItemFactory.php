<?php

namespace App\Domains\Procurement\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Summary of PurchaseRequestItemFactory
 * @method PurchaseRequestItem create(...$params)
 */
class PurchaseRequestItemFactory extends Factory
{
    protected $model = PurchaseRequestItem::class;

    public function definition(): array
    {
        return [
            'purchase_request_id' => PurchaseRequest::factory(),
            'item_id' => Item::factory(),
            'uom_id' => 1,
            'quantity_requested' => fake()->randomNumber(2, true),
            'remarks' => fake()->realText(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (PurchaseRequestItem $item) {
            if ($item->supplierItemOffer) {
                $item->item_id = $item->supplierItemOffer->supplierItem->item_id;
                $item->uom_id = $item->supplierItemOffer->uom_id;
            }
        });
    }
}