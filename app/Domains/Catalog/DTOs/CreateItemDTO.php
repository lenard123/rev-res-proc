<?php

namespace App\Domains\Catalog\DTOs;

use App\Domains\Attribute\DTOs\AttributeDTO;
use App\Domains\Attribute\Models\Attribute;
use App\Domains\Catalog\Models\Item;

class CreateItemDTO
{
    /**
     * Summary of __construct
     * @param AttributeDTO[] $attributes
     * @param array<string,array<mixed>> $configurable_attributes
     *       Example:
     *       [
     *           'color' => [1, 2, 3],
     *           'size' => [4, 5]
     *       ]
     */
    public function __construct(
        public string $sku,
        public string $type,
        public ?int $parent_id,
        public int $attribute_family_id,
        public array $attributes,
        public array $configurable_attributes,
    ) {
        // Attach SKU to attributes if it doesnt exists        
        if (collect($attributes)->every(fn($attribute) => $attribute->code !== Attribute::CODE_SKU)) {
            $this->attributes[] = AttributeDTO::make(Attribute::CODE_SKU, $sku);
        }
    }

    /**
     * Factory from validated request data
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): CreateItemDTO
    {
        $attributes_data = data_get($data, 'attributes', []);
        $sku = data_get($data, 'sku');

        $attributes_dto = AttributeDTO::mapFromArray(data_get($data, 'attributes', []));

        array_push($attributes_data, AttributeDTO::make(Attribute::CODE_SKU, $sku));

        return new CreateItemDTO(
            $sku,
            data_get($data, 'type', Item::TYPE_SIMPLE),
            data_get($data, 'parent_id'),
            data_get($data, 'attribute_family_id'),
            $attributes_dto,
            data_get($data, 'configurable_attributes', []),
        );
    }
}