<?php

namespace Tests\Unit\Domains\Procurement\Actions;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Exceptions\ConflictException;
use App\Domains\Procurement\Actions\SelectPurchaseRequestItemSupplierAction;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\Supplier\Models\SupplierItemOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SelectPurchaseRequestItemSupplierActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_the_supplier_to_purchase_request_item()
    {
        $this->seed();

        $item = Item::factory()->create();

        $purchaseRequestItem = PurchaseRequestItem::factory()
            ->for($item)
            ->create();

        $supplierItemOffer = SupplierItemOffer::factory()
            ->forItem($item)
            ->create();

        $action = app(SelectPurchaseRequestItemSupplierAction::class);

        $result = $action->handle($purchaseRequestItem, $supplierItemOffer);

        $this->assertEquals($supplierItemOffer->id, $result->supplier_item_offer_id);
    }

    public function test_it_prevents_selecting_different_item_offer()
    {
        $this->seed();

        $item = Item::factory()->create();

        $purchaseRequestItem = PurchaseRequestItem::factory()
            ->for($item)
            ->create();

        $supplierItemOffer = SupplierItemOffer::factory()
            ->create();

        $this->expectException(ConflictException::class);
        $this->expectExceptionMessage(__('procurement.mismatched_supplier_and_pr_item_id'));

        $action = app(SelectPurchaseRequestItemSupplierAction::class);
        $action->handle($purchaseRequestItem, $supplierItemOffer);
    }
}
