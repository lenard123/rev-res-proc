<?php

namespace App\Domains\PurchaseOrder\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\Supplier\Models\SupplierItemOffer;
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
            $supplier_item_offer_ids = array_map(fn($item) => $item->supplier_item_offer_id, $order_items_dto);
            $supplier_item_offers = SupplierItemOffer::query()
                ->with('supplierItem')
                ->whereIn('id', $supplier_item_offer_ids)
                ->get()
                ->keyBy('id');

            foreach($order_items_dto as $order_item_dto)
            {
                $supplier_item_offer = $supplier_item_offers->get($order_item_dto->supplier_item_offer_id);

                if ($supplier_item_offer && $supplier_item_offer->supplierItem->supplier_id !== $createPurchaseOrder->supplier_id) {
                    throw new ConflictException("The selected offer does not belong to the selected supplier");
                }

                $item_id = $supplier_item_offer?->supplierItem?->item_id ?? $order_item_dto->item_id;
                $uom_id = $supplier_item_offer?->uom_id ?? $order_item_dto->uom_id;
                $unit_price = $supplier_item_offer?->last_quoted_price ?? $order_item_dto->unit_price; 

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