<?php

namespace App\Domains\Procurement\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Procurement\Factories\PurchaseRequestItemFactory;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $purchase_request_id
 * @property int $item_id
 * @property int $uom_id
 * @property int|null $supplier_item_offer_id
 * @property int $quantity_requested
 * @property string|null $remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Item $item
 * @property-read \App\Domains\Procurement\Models\PurchaseRequest $purchaseRequest
 * @property-read SupplierItemOffer|null $supplierItemOffer
 * @method static \App\Domains\Procurement\Factories\PurchaseRequestItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem wherePurchaseRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereQuantityRequested($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereSupplierItemOfferId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereUomId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PurchaseRequestItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
