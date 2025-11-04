<?php

namespace App\Domains\Attribute\Models;

use Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Attribute
 * @property string $type
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
