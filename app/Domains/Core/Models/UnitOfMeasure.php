<?php

namespace App\Domains\Core\Models;

use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
    public const CODE_PC = 'pc';
    public const CODE_BOX = 'box';

    public static function getID($code)
    {
        return once(fn() => UnitOfMeasure::where('code', $code)->value('id'));
    }
}