<?php

namespace App\Domains\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\AttributeGroup> $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeFamily whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttributeFamily extends Model
{
    public const DEFAULT_CODE = 'default';

    public function groups()
    {
        return $this->hasMany(AttributeGroup::class);
    }

    public static function getID(string $code)
    {
        return once(fn() => AttributeFamily::where('code', $code)->value('id'));
    }
}
