<?php

namespace App\Domains\Attribute\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Attribute
 *
 * @property string $type
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $is_unique
 * @property int $is_required
 * @property int $is_system
 * @property int $is_configurable
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\AttributeOption> $options
 * @property-read int|null $options_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsConfigurable($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereIsUnique($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Attribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    public const TYPE_TEXT = 'text';
    public const TYPE_SELECT = 'select';

    public const CODE_SKU = 'sku';
    public const CODE_NAME = 'name';
    public const CODE_SIZE = 'size';
    public const CODE_COLOR = 'color';


    public function options()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function getValuesColumn()
    {
        return match($this->type) {
            self::TYPE_TEXT => 'text_value',
            self::TYPE_SELECT => 'integer_value',
        };
    }

    public static function getID(string $code)
    {
        return once(fn() => self::where('code', $code)->value('id'));
    }

    public static function findCache(string $code): ?self
    {
        return Cache::rememberForever("attributes:$code", fn() => self::where('code', $code)->first());
    }
}
