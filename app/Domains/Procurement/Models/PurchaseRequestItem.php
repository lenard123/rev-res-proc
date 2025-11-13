<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Procurement\Factories\PurchaseRequestItemFactory;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    use HasFactory;

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function supplierItemOffer()
    {
        return $this->belongsTo(SupplierItemOffer::class);
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
