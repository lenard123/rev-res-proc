<?php

namespace Database\Seeders;

use App\Domains\Attribute\Actions\CreateItemAction;
use App\Domains\Attribute\DTOs\AttributeDTO;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Attribute\Models\Attribute;
use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Models\ItemAttribute;
use App\Domains\Core\Models\User;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
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
    public const SUPPLIER_ITEM_PILOT_S_BLACK_ID = 1;
    public const SUPPLIER_ITEM_PILOT_M_RED_ID = 2;
    public const SUPPLIER_ITEM_PILOT_S_RED_ID = 3;
    public const SUPPLIER_ITEM_PENTEL_L_BLACK_ID = 4;

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
        $this->call(DummyItemSeeder::class);
        $this->call(DummySupplierSeeder::class);

        $user_1 = User::factory()->create();

        SupplierItem::insert([
            [
                'id' => self::SUPPLIER_ITEM_PILOT_S_BLACK_ID,
                'supplier_id' => DummySupplierSeeder::SUPPLIER_PILOT_ID,
                'item_id' => DummyItemSeeder::ITEM_S_BLACK_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PILOT_M_RED_ID,
                'supplier_id' => DummySupplierSeeder::SUPPLIER_PILOT_ID,
                'item_id' => DummyItemSeeder::ITEM_M_RED_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PILOT_S_RED_ID,
                'supplier_id' => DummySupplierSeeder::SUPPLIER_PILOT_ID,
                'item_id' => DummyItemSeeder::ITEM_S_RED_ID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => self::SUPPLIER_ITEM_PENTEL_L_BLACK_ID,
                'supplier_id' => DummySupplierSeeder::SUPPLIER_PENTEL_ID,
                'item_id' => DummyItemSeeder::ITEM_L_BLACK_ID,
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

        PurchaseRequest::insert([[
            'id' => 1,
            'user_id' => $user_1->id,
            'status' => PurchaseRequest::STATUS_PENDING_APPROVAL,
            'created_at' => now(),
            'updated_at' => now(),
        ]]);

        PurchaseRequestItem::insert([
            [
                'id' => 1,
                'purchase_request_id' => 1,
                'item_id' => DummyItemSeeder::ITEM_L_BLACK_ID,
                'quantity_requested' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'purchase_request_id' => 1,
                'item_id' => DummyItemSeeder::ITEM_S_BLACK_ID,
                'quantity_requested' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
