<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Supplier\Factories\SupplierItemOfferFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of SupplierItemOffer
 * @property int $id
 * @property SupplierItem $supplierItem
 * @property string $status
 */
class SupplierItemOffer extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';

    public function supplierItem()
    {
        return $this->belongsTo(SupplierItem::class);
    }

    protected static function newFactory()
    {
        return SupplierItemOfferFactory::new();
    }
}