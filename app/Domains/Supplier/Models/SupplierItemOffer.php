<?php

namespace App\Domains\Supplier\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierItemOffer extends Model
{
    public function supplierItem()
    {
        return $this->belongsTo(SupplierItem::class);
    }
}