<?php

namespace Test\Unit\Domains\PurchaseOrder\Actions;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\User;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use App\Domains\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderItemDTO;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Supplier\Models\SupplierItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePurchaseOrderActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_successfully_create_po_from_pr()
    {
        $this->seed();

        $action = app(CreatePurchaseOrderAction::class);

        $supplier = Supplier::factory()->create();
        $supplier_items = SupplierItem::factory()->withDefaultOffer()->count(3)->for($supplier)->create();

        $purchase_request = PurchaseRequest::factory()->processing()->create();
        $pr_items = $supplier_items->map(
            fn($supplier_item) => PurchaseRequestItem::factory()->for($purchase_request)->for($supplier_item->defaultOffer)->create()
        );

        $user = User::factory()->create();

        $dto = new CreatePurchaseOrderDTO(
            $supplier->id,
            $purchase_request->id,
            $user->id,
            fake()->sentence(),
            $pr_items->map(fn($item) => CreatePurchaseOrderItemDTO::fromPurchaseRequestItem($item, 20, "TEST Remarks"))->toArray()
        );

        $purchase_order = $action->handle($dto);

        $this->assertEquals(PurchaseOrderStatus::DRAFT, $purchase_order->status);
        $this->assertEquals(PurchaseOrderFulfillmentStatus::OPEN, $purchase_order->fulfillment_status);
        $this->assertEquals(PurchaseOrderPaymentStatus::UNPAID, $purchase_order->payment_status);
        $this->assertCount(3, $purchase_order->purchaseOrderItems);        
    }
}
