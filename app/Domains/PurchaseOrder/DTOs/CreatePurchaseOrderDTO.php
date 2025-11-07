<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\PurchaseOrder\Requests\CreatePurchaseOrderRequest;
use App\Domains\Supplier\Models\SupplierItemOffer;

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
            order_items: data_get($data, 'order_items', []),
        );
    }
 
    
    /**
     * Factory to generate DTO from request
     * @return self
     */
    public static function fromRequest(CreatePurchaseOrderRequest $request): self
    {
        $order_items = $request->validated('order_items', []);

        $order_items_dto = array_map(function ($item) {
            return new CreatePurchaseOrderItemDTO(
                data_get($item, 'supplier_item_offer_id'),
                data_get($item, 'item_id'),
                data_get($item, 'uom_id'),
                data_get($item, 'unit_price'),
                data_get($item, 'quantity_ordered'),
                data_get($item, 'remarks'),
            );
        }, $order_items);

        return self::fromArray(array_merge($request->validated(), [
            'user_id' => $request->user()->getKey(),
            'order_items' => $order_items_dto
        ]));
    }
}