<?php

namespace App\Domains\Supplier\Actions;

use App\Domains\Supplier\Models\Supplier;

class SyncSupplierItemsAction
{
    public function handle(Supplier $supplier, array $item_ids)
    {
        return $supplier->items()->syncWithoutDetaching($item_ids);
    }
}