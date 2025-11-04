<?php

namespace App\Domains\Attribute\Models;

use Illuminate\Database\Eloquent\Model;

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
