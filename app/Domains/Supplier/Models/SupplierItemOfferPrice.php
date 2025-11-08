<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Supplier\Factories\SupplierItemOfferPriceFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(SupplierItemOfferPriceFactory::class)]
/**
 * @property int $id
 * @property int $supplier_item_offer_id
 * @property string $unit_price
 * @property string $currency
 * @property string $valid_from
 * @property string|null $valid_to
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Supplier\Models\SupplierItemOffer $offer
 * @method static \App\Domains\Supplier\Factories\SupplierItemOfferPriceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereSupplierItemOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereUnitPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOfferPrice whereValidTo($value)
 * @mixin \Eloquent
 */
class SupplierItemOfferPrice extends Model
{
    use HasFactory;

    public function offer()
    {
        return $this->belongsTo(SupplierItemOffer::class, 'supplier_item_offer_id');
    }
}
