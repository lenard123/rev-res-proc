<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Factories\SupplierItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of SupplierItem
 * @property int $item_id
 * @property string $status
 */
class SupplierItem extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
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