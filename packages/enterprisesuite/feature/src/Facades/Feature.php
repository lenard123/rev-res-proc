<?php

namespace Enterprisesuite\Feature\Facades;

use Enterprisesuite\Feature\FeatureManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static bool enabled(string $key, $target = null)
 * @method static bool disabled(string $key, $target = null)
 * @method static bool for(string $key, $target = null)
 */
class Feature extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FeatureManager::class;
    }
}