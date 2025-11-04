<?php

namespace App\Domains\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_group_mappings', 'attribute_group_id', 'attribute_id');
    }
}
