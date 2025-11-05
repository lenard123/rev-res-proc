<?php

namespace Database\Seeders;

use App\Domains\Attribute\Actions\CreateItemAction;
use App\Domains\Attribute\DTOs\AttributeDTO;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Attribute\Models\Attribute;
use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Models\ItemAttribute;
use App\Domains\Supplier\Actions\AddSupplierItemAction;
use App\Domains\Supplier\Actions\CreateSupplierAction;
use App\Domains\Supplier\Actions\SyncSupplierItemsAction;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Database\Seeder;
use Str;

class MockDataSeeder extends Seeder
{

    const ITEM_S_BLACK_ID = 2;
    const ITEM_M_RED_ID = 3;
    const ITEM_S_RED_ID = 4;
    const ITEM_L_BLACK_ID = 5;

    const SUPPLIER_PILOT_ID = 1;
    const SUPPLIER_PENTEL_ID = 2;

    const SUPPLIER_ITEM_PILOT_S_BLACK_ID = 1;
    const SUPPLIER_ITEM_PILOT_M_RED_ID = 2;
    const SUPPLIER_ITEM_PILOT_S_RED_ID = 3;
    const SUPPLIER_ITEM_PENTEL_L_BLACK_ID = 4;

    public function __construct(
        private CreateSupplierAction $createSupplier,
        private SyncSupplierItemsAction $syncSupplierItems,
        private AddSupplierItemAction $addSupplierItem,
    ) {}



    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DatabaseSeeder::class);

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

        Supplier::insert([
            [
                'id' => self::SUPPLIER_PILOT_ID,
                'code' => 'SPLR-0001',
                'name' => 'Pilot',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_PENTEL_ID,
                'code' => 'SPLR-0002',
                'name' => 'Pentel',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        SupplierItem::insert([
            [
                'id' => self::SUPPLIER_ITEM_PILOT_S_BLACK_ID,
                'supplier_id' => self::SUPPLIER_PILOT_ID,
                'item_id' => self::ITEM_S_BLACK_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PILOT_M_RED_ID,
                'supplier_id' => self::SUPPLIER_PILOT_ID,
                'item_id' => self::ITEM_M_RED_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PILOT_S_RED_ID,
                'supplier_id' => self::SUPPLIER_PILOT_ID,
                'item_id' => self::ITEM_S_RED_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PENTEL_L_BLACK_ID,
                'supplier_id' => self::SUPPLIER_PENTEL_ID,
                'item_id' => self::ITEM_L_BLACK_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        SupplierItemOffer::insert([
            [
                'id' => 1,
                'supplier_item_id' => self::SUPPLIER_ITEM_PILOT_S_BLACK_ID,
                'uom_id' => 2,
                'conversion_factor_to_item_uom' => 10,
                'last_quoted_price' => 500,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'supplier_item_id' => self::SUPPLIER_ITEM_PILOT_M_RED_ID,
                'uom_id' => 2,
                'conversion_factor_to_item_uom' => 10,
                'last_quoted_price' => 575,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'supplier_item_id' => self::SUPPLIER_ITEM_PILOT_S_RED_ID,
                'uom_id' => 2,
                'conversion_factor_to_item_uom' => 10,
                'last_quoted_price' => 500,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'supplier_item_id' => self::SUPPLIER_ITEM_PENTEL_L_BLACK_ID,
                'uom_id' => 2,
                'conversion_factor_to_item_uom' => 12,
                'last_quoted_price' => 750,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'supplier_item_id' => self::SUPPLIER_ITEM_PENTEL_L_BLACK_ID,
                'uom_id' => 1,
                'conversion_factor_to_item_uom' => 1,
                'last_quoted_price' => 100,
                'is_default' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
