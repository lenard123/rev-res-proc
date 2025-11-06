<?php

namespace App\Domains\Supplier\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Summary of SupplierItem
 * @property int $item_id
 */
class SupplierItem extends Model
{
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}