<?php

namespace App\Domains\PurchaseOrder\DTOs;

class CreatePurchaseOrderDTO
{
    /**
     * Summary of __construct
     * @param int $supplier_id
     * @param int $user_id
     * @param mixed $remarks
     * @param array<CreatePurchaseOrderItemDTO> $order_items
     */
    public function __construct(
        public int $supplier_id,
        public ?int $purchase_request_id,
        public int $user_id,
        public ?string $remarks,
        public array $order_items,
    ) {}
}