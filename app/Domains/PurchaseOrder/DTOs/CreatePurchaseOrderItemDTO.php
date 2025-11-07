<?php

namespace App\Domains\PurchaseOrder\DTOs;

class CreatePurchaseOrderItemDTO
{
    public function __construct(
        public int $item_id,
        public int $uom_id,
        public ?int $supplier_item_offer_id,
        public int $quantity_ordered,
        public float $unit_price,
        public ?string $remarks,
    ) {}
}