<?php

namespace App\Domains\Supplier\Actions;

use App\Domains\Supplier\Models\Supplier;
use Str;

class CreateSupplierAction
{
    public function handle(array $supplier_data): Supplier
    {
        $supplier_data['code'] ??= Str::uuid()->toString();
        $supplier = Supplier::create($supplier_data);

        return $supplier;
    }
}