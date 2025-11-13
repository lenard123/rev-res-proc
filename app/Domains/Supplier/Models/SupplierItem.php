<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Factories\SupplierItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of SupplierItem
 *
 * @property int $id
 * @property int $supplier_id
 * @property int $item_id
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Supplier\Models\SupplierItemOffer|null $defaultOffer
 * @property-read Item $item
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Supplier\Models\SupplierItemOffer> $offers
 * @property-read int|null $offers_count
 * @property-read \App\Domains\Supplier\Models\Supplier $supplier
 * @method static \App\Domains\Supplier\Factories\SupplierItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereSupplierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SupplierItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SupplierItem extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function offers()
    {
        return $this->hasMany(SupplierItemOffer::class);
    }

    public function defaultOffer()
    {
        return $this->hasOne(SupplierItemOffer::class)->ofMany('is_default', 'MAX');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected static function newFactory()
    {
        return SupplierItemFactory::new();
    }
}