<?php

namespace App\Domains\PurchaseOrder\Policies;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;

class CreatePurchaseOrderPolicy
{
    public function enforce(CreatePurchaseOrderDTO $createPurchaseOrderDTO): void
    {
        $purchaseRequest = $createPurchaseOrderDTO->getPurchaseRequest();
        $purchaseRequestItems = $createPurchaseOrderDTO->orderPurchaseRequestItems();
        $supplierOffers = $createPurchaseOrderDTO->orderSupplierItemOffers();
        $order_items = $createPurchaseOrderDTO->order_items;

        // PR Bounded Validation
        if ($purchaseRequest) 
        {
            if ($purchaseRequest->status !== PurchaseRequestStatus::PROCESSING) 
                throw new ConflictException("The selected Purchase Request is not yet processing");

            foreach ($order_items as $idx => $order_item)
            {
                $purchaseRequestItem = $purchaseRequestItems->get($order_item->purchase_request_item_id);
                if ($purchaseRequestItem?->purchase_request_id !== $createPurchaseOrderDTO->purchase_request_id)
                    throw new ConflictException("Order item #{$idx} does not belong to the selected Purchase Request.");
            }
        }


        foreach ($order_items as $idx => $order_item)
        {
            $purchaseRequestItem = $purchaseRequestItems->get($order_item->purchase_request_item_id);
            $supplierOffer = $supplierOffers->get($order_item->supplier_item_offer_id, $purchaseRequestItem->supplierItemOffer);

            if (!$supplierOffer) {
                throw new ConflictException("Please select a supplier for Order Item #{$idx}.");
            }

            if ($purchaseRequestItem) {
                if ($purchaseRequestItem->purchaseRequest->status !== PurchaseRequestStatus::PROCESSING) {
                    throw new ConflictException("Order item #{$idx} Purchase Request is not processing");
                }
                if ($purchaseRequestItem->item_id !== $supplierOffer->supplierItem->item_id) {
                    throw new ConflictException("Order item #{$idx} Supplier Item and Purchase Request Item does not match");
                }
            }

            if ($supplierOffer->supplierItem->supplier_id !== $createPurchaseOrderDTO->supplier_id) {
                throw new ConflictException("Selected offer on item #{$idx} does not belong to the supplier you chose.");                
            }
        }
    }
}
