<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Supplier\Factories\SupplierItemOfferPriceFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Model;

/** @method static SupplierItemOfferPriceFactory factory(...$parameters) */
#[UseFactory(SupplierItemOfferPriceFactory::class)]
class SupplierItemOfferPrice extends Model
{
    public function offer()
    {
        return $this->belongsTo(SupplierItemOffer::class, 'supplier_item_offer_id');
    }
}
