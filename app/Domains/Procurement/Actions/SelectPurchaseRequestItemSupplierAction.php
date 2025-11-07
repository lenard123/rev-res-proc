<?php

namespace App\Domains\Procurement\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\Supplier\Actions\OfferAvailabilityCheckerAction;
use App\Domains\Supplier\Models\SupplierItemOffer;

class SelectPurchaseRequestItemSupplierAction
{

    public function __construct(
        private OfferAvailabilityCheckerAction $offerAvailabilityChecker
    ) {}

    public function handle(PurchaseRequestItem $purchaseRequestItem, SupplierItemOffer $supplierItemOffer)
    {
        if ($supplierItemOffer->supplierItem->item_id !== $purchaseRequestItem->item_id) {
            throw new ConflictException(__('procurement.mismatched_supplier_and_pr_item_id'));
        }

        if ($purchaseRequestItem->purchaseRequest->status !== PurchaseRequestStatus::PROCESSING) {
            throw new ConflictException("Purchase Request can only be modified during processing status");
        }

        if ($this->offerAvailabilityChecker->handle($supplierItemOffer) === FALSE) {
            throw new ConflictException("The selected offer is not available");
        }

        $purchaseRequestItem->update([
            'supplier_item_offer_id' => $supplierItemOffer->id
        ]);

        return $purchaseRequestItem;
    }
}