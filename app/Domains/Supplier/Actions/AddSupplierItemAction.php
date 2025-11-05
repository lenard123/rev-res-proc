<?php

namespace App\Domains\Supplier\Actions;

use App\Domains\Supplier\Models\SupplierItem;

class AddSupplierItemAction
{
    public function handle(int $supplier_id, int $item_id)
    {
        return SupplierItem::firstOrCreate(
            ['supplier_id' => $supplier_id, 'item_id' => $item_id]
        );
    }
}