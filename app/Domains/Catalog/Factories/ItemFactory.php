<?php

namespace App\Domains\Catalog\Factories;

use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\UnitOfMeasure;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'sku' => Str::uuid()->toString(),
            'type' => Item::TYPE_SIMPLE,
            'attribute_family_id' => AttributeFamily::getID(AttributeFamily::DEFAULT_CODE),
            'base_uom_id' => UnitOfMeasure::getID(UnitOfMeasure::CODE_PC),
        ];
    }
}