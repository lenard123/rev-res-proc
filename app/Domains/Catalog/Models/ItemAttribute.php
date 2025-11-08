<?php

namespace App\Domains\Catalog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $item_id
 * @property int $attribute_id
 * @property string|null $text_value
 * @property int|null $integer_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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

}
