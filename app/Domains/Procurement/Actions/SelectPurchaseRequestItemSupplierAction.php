<?php

namespace App\Domains\Procurement\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;

class SelectPurchaseRequestItemSupplierAction
{
    public function handle(PurchaseRequestItem $purchaseRequestItem, SupplierItemOffer $supplierItemOffer)
    {
        if ($supplierItemOffer->supplierItem->item_id !== $purchaseRequestItem->item_id) {
            throw new ConflictException(__('procurement.mismatched_supplier_and_pr_item_id'));
        }

        if ($supplierItemOffer->status !== SupplierItemOffer::STATUS_ACTIVE) {
            throw new ConflictException("The selected offer is no longer active");
        }

        if ($supplierItemOffer->supplierItem->status !== SupplierItem::STATUS_ACTIVE) {
            throw new ConflictException("The supplier item is no longer active");
        }

        $purchaseRequestItem->update([
            'supplier_item_offer_id' => $supplierItemOffer->id
        ]);

        return $purchaseRequestItem;
    }
}