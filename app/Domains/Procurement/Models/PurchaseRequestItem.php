<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Procurement\Factories\PurchaseRequestItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    use HasFactory;

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    protected static function newFactory()
    {
        return PurchaseRequestItemFactory::new();
    }    
}
