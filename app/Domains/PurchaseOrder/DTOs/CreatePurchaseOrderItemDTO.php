<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use InvalidArgumentException;

class CreatePurchaseOrderItemDTO
{
    public function __construct(
        public ?int $supplier_item_offer_id,
        public int $quantity_ordered,
        public ?string $remarks,
        public ?int $purchase_request_item_id,
    ) {

        if ($supplier_item_offer_id === null) {
            throw new InvalidArgumentException("Enter Supplier Offer ID");
        }

        if ($quantity_ordered <= 0) {
            throw new InvalidArgumentException('Quantity ordered must be greater than zero.');
        }
    }

    public static function fromPurchaseRequestItem(PurchaseRequestItem $purchaseRequestItem, int $quantity_ordered, ?string $remarks)
    {
        return new self(
            $purchaseRequestItem->supplier_item_offer_id,
            $quantity_ordered,
            $remarks,
            $purchaseRequestItem->id,
        );
    }
}
