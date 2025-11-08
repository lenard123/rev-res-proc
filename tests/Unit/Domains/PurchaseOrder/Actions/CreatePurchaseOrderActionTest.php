<?php

namespace Test\Unit\Domains\PurchaseOrder\Actions;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\User;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePurchaseOrderActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_successfully_create_po_from_pr()
    {
        $this->seed();

        $action = app(CreatePurchaseOrderAction::class);

        $supplier = Supplier::factory()
            ->supplierItem(3)
            ->create();

        $items = $supplier->items;

        $purchase_request = PurchaseRequest::factory()
            ->create();

        $user = User::factory()->create();

        $dto = new CreatePurchaseOrderDTO(
            $supplier->id,
            $purchase_request->id,
            $user->id,
            fake()->sentence(),
            [

            ]
        );
    }
}
