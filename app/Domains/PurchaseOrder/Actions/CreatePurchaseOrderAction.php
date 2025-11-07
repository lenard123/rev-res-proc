<?php

namespace App\Domains\PurchaseOrder\Actions;

use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use DB;

class CreatePurchaseOrderAction
{
    public function handle(CreatePurchaseOrderDTO $createPurchaseOrder): PurchaseOrder
    {
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
            foreach($order_items_dto as $order_item_dto)
            {
                $purchaseOrder->purchaseOrderItems()->create([
                    'item_id' => $order_item_dto->item_id,
                    'uom_id' => $order_item_dto->uom_id,
                    'supplier_item_offer_id' => $order_item_dto->supplier_item_offer_id,
                    'quantity_ordered' => $order_item_dto->quantity_ordered,
                    'remarks' => $order_item_dto->remarks,
                ]);
            }

            return $purchaseOrder;
        });
    }
}