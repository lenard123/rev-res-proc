<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Procurement\Factories\PurchaseRequestItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of PurchaseRequestItem
 * @property int $item_id
 * @property int $supplier_item_offer_id
 * @property PurchaseRequest $purchaseRequest
 */
class PurchaseRequestItem extends Model
{
    use HasFactory;

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory()
    {
        return PurchaseRequestItemFactory::new();
    }    
}
