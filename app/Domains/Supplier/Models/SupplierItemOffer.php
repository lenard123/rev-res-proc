<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Supplier\Factories\SupplierItemOfferFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of SupplierItemOffer
 *
 * @property int $id
 * @property int $uom_id
 * @property float $last_quoted_price
 * @property SupplierItem $supplierItem
 * @property string $status
 * @property int $supplier_item_id
 * @property string|null $supplier_sku The supplier's internal SKU / part number.
 * @property string|null $description_override Sometimes your catalog name is "Polypropylene Container 32L" but vendor calls it "STORAGE BIN GRAY 32L HD". You want to store how THEY label it.
 * @property string $conversion_factor_to_item_uom how many of the item's base UOM are in 1 of this offer's UOM
 * @property string $currency
 * @property string $min_order_qty
 * @property int $is_default
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Supplier\Models\SupplierItemOfferPrice> $prices
 * @property-read int|null $prices_count
 * @method static \App\Domains\Supplier\Factories\SupplierItemOfferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereConversionFactorToItemUom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereDescriptionOverride($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereLastQuotedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereMinOrderQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereSupplierItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereSupplierSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItemOffer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SupplierItemOffer extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';

    public function supplierItem()
    {
        return $this->belongsTo(SupplierItem::class);
    }

    public function prices()
    {
        return $this->hasMany(SupplierItemOfferPrice::class);
    }

    protected static function newFactory()
    {
        return SupplierItemOfferFactory::new();
    }
}