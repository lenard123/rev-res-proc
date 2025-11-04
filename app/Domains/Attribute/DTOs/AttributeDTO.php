<?php

namespace App\Domains\Attribute\DTOs;

use App\Domains\Attribute\Models\Attribute;

class AttributeDTO
{
    public function __construct(
        public string $code,
        public mixed $value,
    ) {}

    public function attribute(): Attribute
    {
        return Attribute::findCache($this->code);
    }

    public static function make(string $code, mixed $value)
    {
        return new self($code, $value);
    }

    /**
     * Factory to create array of AttributeDTO from validated request data
     * @param array<string,mixed> $attributes
     *      Example:
     *      ['color' => 1, 'size' => 5]
     * @return self[]
     */
    public static function mapFromArray(array $attributes): array
    {
        return array_map(
            fn($value, $code) => self::make(
                $code, 
                $value
            ), 
            $attributes,
            array_keys($attributes)
        );
    }
}