<?php

namespace App\Domains\PurchaseOrder\DTOs;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\PurchaseOrder\Requests\CreatePurchaseOrderRequest;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Support\Collection;
use InvalidArgumentException;

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
    ) {
        if (count($order_items) == 0) {
            throw new InvalidArgumentException("Order Items is required");
        }
    }


    public static function fromArray(array $data): self
    {
        return new self(
            data_get($data, 'supplier_id'),
            data_get($data, 'purchase_request_id'),
            data_get($data, 'user_id'),
            data_get($data, 'remarks'),
            data_get($data, 'order_items', []),
        );
    }
 
    public function getPurchaseRequest(): ?PurchaseRequest
    {
        return once(function () {
            if (!$this->purchase_request_id)
                return null;
            return PurchaseRequest::findOrFail($this->purchase_request_id);
        });
    }

    /**
     * Summary of orderPurchaseRequestItems
     * @return Collection<int,PurchaseRequestItem>
     */
    public function orderPurchaseRequestItems(): Collection
    {
        return once(function () {
            $purchase_request_item_ids = array_reduce(
                $this->order_items,
                fn($acm, $item) => $item->purchase_request_item_id ? 
                    array_merge($acm, [$item->purchase_request_item_id]) 
                    : $acm,
                []
            );
    
            if (count($purchase_request_item_ids) == 0)
                return collect();
    
            return PurchaseRequestItem::query()
                ->whereIn('id', $purchase_request_item_ids)
                ->get()
                ->keyBy('id');
        });
    }

    /**
     * Summary of orderPurchaseRequestItems
     * @return Collection<int,SupplierItemOffer>
     */
    public function orderSupplierItemOffers()
    {
        return once(function () {
            $supplier_item_offer_ids = array_reduce(
                $this->order_items,
                fn($acm, $item) => $item->supplier_item_offer_id ? 
                    array_merge($acm, [$item->supplier_item_offer_id]) 
                    : $acm,
                []
            );

            if (count($supplier_item_offer_ids) == 0)
                return collect();

            return SupplierItemOffer::query()
                ->whereIn('id', $supplier_item_offer_ids)
                ->get()
                ->keyBy('id');
        });
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
                data_get($item, 'quantity_ordered'),
                data_get($item, 'remarks'),
                data_get($item, 'purchase_request_item_id'),
            );
        }, $order_items);

        return self::fromArray(array_merge($request->validated(), [
            'user_id' => $request->user()->getKey(),
            'order_items' => $order_items_dto
        ]));
    }
}