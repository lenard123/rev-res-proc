<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\Supplier\Models\SupplierItemOffer;
use InvalidArgumentException;

class CreatePurchaseOrderItemDTO
{
    public int $item_id;
    public int $uom_id;
    public float $unit_price;

    public function __construct(
        public ?int $supplier_item_offer_id,
        ?int $item_id,
        ?int $uom_id,
        ?float $unit_price,
        public int $quantity_ordered,
        public ?string $remarks,
    ) {

        if ($supplier_item_offer_id === null) {
            if ($item_id === null) {
                throw new InvalidArgumentException('Either supplier_item_offer_id or item_id must be provided.');
            }

            if ($uom_id === null) {
                throw new InvalidArgumentException('Either supplier_item_offer_id or uom_id must be provided.');
            }

            if ($unit_price === null) {
                throw new InvalidArgumentException('Either supplier_item_offer_id or unit_price must be provided.');
            }
        }

        if ($quantity_ordered <= 0) {
            throw new InvalidArgumentException('Quantity ordered must be greater than zero.');
        }

        if ($unit_price !== null && $unit_price < 0) {
            throw new InvalidArgumentException('Unit price cannot be negative.');
        }

        if ($supplier_item_offer_id !== null) {
            $supplier_item_offer = $this->supplierItemOffer();
            $this->item_id = $supplier_item_offer->supplierItem->item_id;
            $this->uom_id = $supplier_item_offer->uom_id;
            $this->unit_price = $supplier_item_offer->last_quoted_price;
        }
    }

    public function supplierItemOffer(): ?SupplierItemOffer
    {
        return once(fn() => (
            $this->supplier_item_offer_id === null 
                ? null
                : SupplierItemOffer::with('supplierItem')->findOrFail($this->supplier_item_offer_id
        )));
    }

    public static function fromArray(array $data): self
    {
        return new self(
            data_get($data, 'supplier_item_offer_id'),
            data_get($data, 'item_id'),
            data_get($data, 'uom_id'),
            data_get($data, 'unit_price'),
            data_get($data, 'quantity_ordered'),
            data_get($data, 'remarks'),
        );
    }
}
