<?php

namespace App\Domains\PurchaseOrder\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\PurchaseOrder\Models\PurchaseOrderItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Domains\PurchaseOrder\Models\PurchaseOrderItem>
 */
class PurchaseOrderItemFactory extends Factory
{
    protected $model = PurchaseOrderItem::class;

    public function definition(): array
    {
        return [
            'purchase_order_id' => PurchaseOrder::factory(),
            'quantity_ordered' => rand(20, 200),
            'supplier_item_offer_id' => SupplierItemOffer::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (PurchaseOrderItem $item) {
            if ($item->uom_id == null) {
                $item->uom_id = $item->supplierItemOffer->uom_id;
            }

            if ($item->unit_price == null) {
                $item->unit_price = $item->supplierItemOffer->last_quoted_price;
            }

            if ($item->item_id == null) {
                $item->item_id = $item->supplierItemOffer->supplierItem->item_id;
            }
        });
    }
}
