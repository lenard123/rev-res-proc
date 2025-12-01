<?php

namespace App\Domains\Catalog\Models;

use App\Domains\Attribute\Models\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $item_id
 * @property int $attribute_id
 * @property string|null $text_value
 * @property int|null $integer_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Attribute $attribute
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereIntegerValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereTextValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ItemAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ItemAttribute extends Model
{
    public function getValueAttribute()
    {
        return match($this->attribute->type) {
            Attribute::TYPE_TEXT => $this->text_value,
            Attribute::TYPE_SELECT => $this->integer_value,
        };
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
