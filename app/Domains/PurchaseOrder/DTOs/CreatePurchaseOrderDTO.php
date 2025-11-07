<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\PurchaseOrder\Requests\CreatePurchaseOrderRequest;

class CreatePurchaseOrderDTO
{
    /**
     * Summary of __construct
     * @param int $supplier_id
     * @param int $purchase_request_id
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


    public static function fromArray(array $data): self
    {
        return new self(
            supplier_id: data_get($data, 'supplier_id'),
            purchase_request_id: data_get($data, 'purchase_request_id'),
            user_id: data_get($data, 'user_id'),
            remarks: data_get($data, 'remarks'),
            order_items: array_map(
                fn ($order_item) => CreatePurchaseOrderItemDTO::fromArray($order_item),
                data_get($data, 'order_items', [])
            ),
        );
    }
 
    
    /**
     * Factory to generate DTO from request
     * @return self
     */
    public static function fromRequest(CreatePurchaseOrderRequest $request): self
    {
        return self::fromArray($request->validated() + [
            'user_id' => $request->user()->id,
        ]);
    }
}