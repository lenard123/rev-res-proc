<?php

namespace Enterprisesuite\Feature\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Feature
 * @property bool $is_enabled
 */
class Feature extends Model
{
    protected $fillable = ['key', 'name', 'description', 'is_enabled', 'rollout_percentage', 'metadata'];

    protected $casts = [
        'is_enabled' => 'boolean',
        'metadata' => 'array',
    ];
}
