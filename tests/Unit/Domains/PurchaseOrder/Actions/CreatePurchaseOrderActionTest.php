<?php

namespace Test\Unit\Domains\PurchaseOrder\Actions;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\User;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\PurchaseOrder\Actions\CreatePurchaseOrderAction;
use App\Domains\PurchaseOrder\DTOs\CreatePurchaseOrderDTO;
use App\Domains\Supplier\Models\Supplier;
use Tests\TestCase;

class CreatePurchaseOrderActionTest extends TestCase
{
    public function test_it_successfully_create_po_from_pr()
    {
        $action = app(CreatePurchaseOrderAction::class);

        $items = Item::factory()
            ->count(3)
            ->create();

        $supplier = Supplier::factory()->create();

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
