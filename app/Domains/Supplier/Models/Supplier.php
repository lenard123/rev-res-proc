<?php

namespace App\Domains\Supplier\Models;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Factories\SupplierFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 * @property int $id
 */
class Supplier extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->belongsToMany(Item::class, 'supplier_items');
    }

    protected static function newFactory()
    {
        return SupplierFactory::new();
    }
}
