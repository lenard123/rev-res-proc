<?php

namespace App\Domains\PurchaseOrder\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderItemDTO;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\PurchaseOrder\Policies\CreatePurchaseOrderPolicy;
use App\Domains\Supplier\Models\SupplierItemOffer;
use DB;
use Illuminate\Support\Collection;

/**
 * There can be a lot of scenarios when it comes to creating Purchase Order
 * 
 * 1. A single PO is directly tied to a Single PR
 * 1A. All Items of PR is added to a PO
 * 1B. Only subset of PR Items are in the PO
 * 2. The PO consist of multiple PRs (NOT SUPPORTED YET)
 * 3. PO is not tied to any PR
 * 
 */
class CreatePurchaseOrderAction
{
    public function __construct(
        private CreatePurchaseOrderPolicy $policy,
    ) {}

    /**
     * Summary of getPurchaseRequestItems
     * @param CreatePurchaseOrderItemDTO[] $order_items
     * @return Collection<int,PurchaseRequestItem>
     */
    private function getPurchaseRequestItems(array $order_items): Collection
    {
        $purchaseRequestItemIds = array_map(fn($item) => $item->purchase_request_item_id, $order_items);

        if (count($order_items) == 0)
            return collect();

        return PurchaseRequestItem::query()
            ->with('purchaseRequest')
            ->with('supplierItemOffer.supplierItem')
            ->whereIn('id', $purchaseRequestItemIds)
            ->get()
            ->keyBy('id');
    }

    public function handle(CreatePurchaseOrderDTO $createPurchaseOrder): PurchaseOrder
    {   
        $this->policy->enforce($createPurchaseOrder);


        return DB::transaction(function () use ($createPurchaseOrder) {
            /** @var PurchaseOrder $purchaseOrder */
            $purchaseOrder = PurchaseOrder::create([
                'purchase_request_id' => $createPurchaseOrder->purchase_request_id,
                'supplier_id' => $createPurchaseOrder->supplier_id,
                'user_id' => $createPurchaseOrder->user_id,
                'status' => PurchaseOrderStatus::DRAFT,
                'fulfillment_status' => PurchaseOrderFulfillmentStatus::OPEN,
                'payment_status' => PurchaseOrderPaymentStatus::UNPAID,
                'remarks' => $createPurchaseOrder->remarks,
            ]);

            $order_items_dto = $createPurchaseOrder->order_items;
            $supplier_item_offers = $createPurchaseOrder->orderSupplierItemOffers();
            $purchase_request_items = $createPurchaseOrder->orderPurchaseRequestItems();

            foreach($order_items_dto as $order_item_dto)
            {
                $purchase_request_item = $purchase_request_items->get($order_item_dto->purchase_request_item_id);
                $supplier_item_offer = $supplier_item_offers->get($order_item_dto->supplier_item_offer_id, $purchase_request_item->supplierItemOffer);

                $item_id = $supplier_item_offer?->supplierItem?->item_id;
                $uom_id = $supplier_item_offer?->uom_id;
                $unit_price = $supplier_item_offer?->last_quoted_price;

                $purchaseOrder->purchaseOrderItems()->create([
                    'supplier_item_offer_id' => $order_item_dto->supplier_item_offer_id,
                    'item_id' => $item_id,
                    'uom_id' => $uom_id,
                    'unit_price' => $unit_price,
                    'quantity_ordered' => $order_item_dto->quantity_ordered,
                    'remarks' => $order_item_dto->remarks,
                ]);
            }

            return $purchaseOrder;
        });
    }
}