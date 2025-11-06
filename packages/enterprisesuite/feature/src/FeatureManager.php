<?php

namespace Enterprisesuite\Feature;

use Enterprisesuite\Feature\Models\Feature;

class FeatureManager
{
    private $fake_data = [];
    private $fake_enabled = false;

    public function __construct(
        protected array $config
    ) {}

    public function for(string $key, $target = null): bool
    {
        $feature = $this->getFeature($key);

        if ($this->fake_enabled && array_key_exists($key, $this->fake_data)) {
            return boolval($this->fake_data[$key]);
        }

        if (!$feature) {
            return false;
        }

        return $feature->is_enabled;
    }

    public function enabled(string $key, $target = null): bool
    {
        return $this->for($key, $target);
    }

    public function disabled(string $key, $target = null): bool
    {
        return ! $this->for($key, $target);
    }

    public function fake(array $fake_data)
    {
        $this->fake_data = $fake_data;
        $this->fake_enabled = true;
    }

    protected function getFeature(string $key): ?Feature
    {
        if (! data_get($this->config, 'cache.enabled', false)) {
            return Feature::where('key', $key)->first();
        }

        $cache = app('cache');
        $prefix = data_get($this->config, 'cache.key_prefix', 'feature_flags:');
        $ttl = data_get($this->config, 'cache.ttl', 60);

        return $cache->remember("{$prefix}{$key}", $ttl, function () use ($key) {
            return Feature::where('key', $key)->first();
        });
    }
}
