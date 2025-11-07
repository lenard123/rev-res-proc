<?php

namespace App\Domains\Supplier\Actions;

use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;

class OfferAvailabilityCheckerAction
{
    public function handle(SupplierItemOffer $supplierItemOffer): bool
    {
        if ($supplierItemOffer->status !== SupplierItemOffer::STATUS_ACTIVE) {
            return false;
        }

        if ($supplierItemOffer->supplierItem->status !== SupplierItem::STATUS_ACTIVE) {
            return false;
        }

        return true;
    }
}