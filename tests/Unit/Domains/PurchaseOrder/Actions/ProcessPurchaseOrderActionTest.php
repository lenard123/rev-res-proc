<?php

namespace Test\Unit\Domains\PurchaseOrder\Actions;

use App\Domains\PurchaseOrder\Actions\ProcessPurchaseOrderAction;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\PurchaseOrder\Models\PurchaseOrderItem;
use Enterprisesuite\Feature\Facades\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessPurchaseOrderActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_successfully_process_a_purchase_order()
    {
        $this->seed();

        $purchase_order = PurchaseOrder::factory()
            ->withItems()
            ->create();
        
        $action = app(ProcessPurchaseOrderAction::class);

        $processed_po = $action->handle($purchase_order);

        $this->assertEquals(PurchaseOrderStatus::PROCESSING, $processed_po->status);
    }

    public function test_it_successfully_process_a_purchase_order_with_approval()
    {
        $this->seed();

        Feature::fake([
            'purchase_order:approval' => true
        ]);

        $purchase_order = PurchaseOrder::factory()
            ->withItems()
            ->create();
        
        $action = app(ProcessPurchaseOrderAction::class);

        $processed_po = $action->handle($purchase_order);

        $this->assertEquals(PurchaseOrderStatus::FOR_APPROVAL, $processed_po->status);
    }
}
