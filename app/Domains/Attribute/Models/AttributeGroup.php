<?php

namespace App\Domains\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $code
 * @property int $attribute_family_id
 * @property string $name
 * @property int $is_system
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Attribute\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereAttributeFamilyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereIsSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AttributeGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttributeGroup extends Model
{
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_group_mappings', 'attribute_group_id', 'attribute_id');
    }
}
