<?php

namespace App\Domains\Procurement\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    public const STATUS_DRAFT = 'draft';

    public function purchaseRequestItems()
    {
        return $this->hasMany(PurchaseRequestItem::class);
    }
}
