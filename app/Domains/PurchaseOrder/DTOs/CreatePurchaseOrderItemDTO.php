<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\Supplier\Models\SupplierItemOffer;
use InvalidArgumentException;

class CreatePurchaseOrderItemDTO
{
    public function __construct(
        public ?int $supplier_item_offer_id,
        public int $item_id,
        public int $uom_id,
        public float $unit_price,
        public int $quantity_ordered,
        public ?string $remarks,
    ) {

        if ($supplier_item_offer_id === null) {
            if ($item_id === 0) {
                throw new InvalidArgumentException('Either supplier_item_offer or item_id must be provided.');
            }

            if ($uom_id === 0) {
                throw new InvalidArgumentException('Either supplier_item_offer or uom_id must be provided.');
            }

            if ($unit_price < 0) {
                throw new InvalidArgumentException('Either supplier_item_offer or unit_price must be provided.');
            }
        }

        if ($quantity_ordered <= 0) {
            throw new InvalidArgumentException('Quantity ordered must be greater than zero.');
        }

        if ($unit_price !== null && $unit_price < 0) {
            throw new InvalidArgumentException('Unit price cannot be negative.');
        }
    }
}
