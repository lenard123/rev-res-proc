<?php

namespace App\Domains\Catalog\Models;

use App\Domains\Catalog\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Item
 * @property int $id
 * @property int $base_uom_id
 */
class Item extends Model
{
    use HasFactory;

    public const TYPE_SIMPLE = 'simple';
    public const TYPE_CONFIGURABLE = 'configurable';

    public function variants()
    {
        return $this->hasMany(Item::class, 'parent_id');
    }

    public function attributes()
    {
        return $this->hasMany(ItemAttribute::class);
    }

    protected static function newFactory()
    {
        return ItemFactory::new();
    }
}
