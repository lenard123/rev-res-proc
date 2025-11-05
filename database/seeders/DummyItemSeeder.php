<?php

namespace Database\Seeders;

use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Models\ItemAttribute;
use Illuminate\Database\Seeder;

class DummyItemSeeder extends Seeder
{
    public const ITEM_S_BLACK_ID = 2;
    public const ITEM_M_RED_ID = 3;
    public const ITEM_S_RED_ID = 4;
    public const ITEM_L_BLACK_ID = 5;


    public function run()
    {
        Item::insert([
            [
                'id' => 1,
                'attribute_family_id' => 1,
                'parent_id' => null,
                'base_uom_id' => 1,
                'sku' => 'ITEM-0001',
                'type' => Item::TYPE_CONFIGURABLE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::ITEM_S_BLACK_ID,
                'attribute_family_id' => 1,
                'parent_id' => 1,
                'base_uom_id' => 1,
                'sku' => 'ITEM-0001-S-BLACK',
                'type' => Item::TYPE_SIMPLE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::ITEM_M_RED_ID,
                'attribute_family_id' => 1,
                'parent_id' => 1,
                'base_uom_id' => 1,
                'sku' => 'ITEM-0001-M-RED',
                'type' => Item::TYPE_SIMPLE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::ITEM_S_RED_ID,
                'attribute_family_id' => 1,
                'parent_id' => 1,
                'base_uom_id' => 1,
                'sku' => 'ITEM-0001-S-RED',
                'type' => Item::TYPE_SIMPLE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::ITEM_L_BLACK_ID,
                'attribute_family_id' => 1,
                'parent_id' => 1,
                'base_uom_id' => 1,
                'sku' => 'ITEM-0001-L-BLACK',
                'type' => Item::TYPE_SIMPLE,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        ItemAttribute::insert([
            [
                'id' => 1,
                'item_id' => self::ITEM_S_BLACK_ID,
                'attribute_id' => 1,
                'text_value' => 'ITEM-0001-S-BLACK',
                'integer_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'item_id' => self::ITEM_S_BLACK_ID,
                'attribute_id' => 3,
                'text_value' => null,
                'integer_value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'item_id' => self::ITEM_S_BLACK_ID,
                'attribute_id' => 4,
                'text_value' => null,
                'integer_value' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 4,
                'item_id' => self::ITEM_M_RED_ID,
                'attribute_id' => 1,
                'text_value' => 'ITEM-0001-M-RED',
                'integer_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'item_id' => self::ITEM_M_RED_ID,
                'attribute_id' => 3,
                'text_value' => null,
                'integer_value' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'item_id' => self::ITEM_M_RED_ID,
                'attribute_id' => 4,
                'text_value' => null,
                'integer_value' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 7,
                'item_id' => self::ITEM_S_RED_ID,
                'attribute_id' => 1,
                'text_value' => 'ITEM-0001-S-RED',
                'integer_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'item_id' => self::ITEM_S_RED_ID,
                'attribute_id' => 3,
                'text_value' => null,
                'integer_value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'item_id' => self::ITEM_S_RED_ID,
                'attribute_id' => 4,
                'text_value' => null,
                'integer_value' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => 10,
                'item_id' => self::ITEM_L_BLACK_ID,
                'attribute_id' => 1,
                'text_value' => 'ITEM-0001-L-BLACK',
                'integer_value' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'item_id' => self::ITEM_L_BLACK_ID,
                'attribute_id' => 3,
                'text_value' => null,
                'integer_value' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'item_id' => self::ITEM_L_BLACK_ID,
                'attribute_id' => 4,
                'text_value' => null,
                'integer_value' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }
}