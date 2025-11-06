<?php

return [
    // Default driver; for now we’ll just use "database"
    'driver' => 'database',

    // Cache settings for flag lookups
    'cache' => [
        'enabled' => env('FEATURE_CACHE_ENABLED', true),
        'ttl' => 60, // seconds
        'key_prefix' => 'feature_flags:',
    ],
];