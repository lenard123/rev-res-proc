<?php

namespace App\Domains\Procurement\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Events\PurchaseRequestProcessed;
use App\Domains\Procurement\Models\PurchaseRequest;

class ProcessPurchaseRequestAction
{
    public function handle(PurchaseRequest $purchaseRequest): PurchaseRequest
    {
        if ($purchaseRequest->purchaseRequestItems()->count() === 0) {
            throw new ConflictException(__('procurement.atleast_1_item_is_required'));
        }

        if ($purchaseRequest->status !== PurchaseRequestStatus::DRAFT) {
            throw new ConflictException(__('procurement.only_draft_can_be_processed'));
        }

        $purchaseRequest->update([
            'status' => PurchaseRequestStatus::PENDING_APPROVAL
        ]);

        event(new PurchaseRequestProcessed());

        return $purchaseRequest;
    }
}