<?php

namespace App\Domains\PurchaseOrder\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use Enterprisesuite\Feature\Facades\Feature;

class ProcessPurchaseOrderAction
{
    public function handle(PurchaseOrder $purchaseOrder)
    {
        if ($purchaseOrder->status !== PurchaseOrderStatus::DRAFT) {
            throw new ConflictException("Only Draft PO Can be posted");
        }

        $purchaseOrder->update([
            'status' => Feature::enabled('purchase_order:approval')
                ? PurchaseOrderStatus::FOR_APPROVAL
                : PurchaseOrderStatus::PROCESSING
        ]);

        return $purchaseOrder;
    }
}
