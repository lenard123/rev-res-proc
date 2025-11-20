<?php

namespace App\Domains\PurchaseOrder\Factories;

use App\Domains\Core\Models\User;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderFulfillmentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderPaymentStatus;
use App\Domains\PurchaseOrder\Enums\PurchaseOrderStatus;
use App\Domains\PurchaseOrder\Models\PurchaseOrder;
use App\Domains\PurchaseOrder\Models\PurchaseOrderItem;
use App\Domains\Supplier\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Domains\PurchaseOrder\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    protected $model = \App\Domains\PurchaseOrder\Models\PurchaseOrder::class;

    public function definition(): array
    {
        return [
            'supplier_id' => Supplier::factory(),
            'user_id' => User::factory(),
            'status' => PurchaseOrderStatus::DRAFT,
            'fulfillment_status' => PurchaseOrderFulfillmentStatus::OPEN,
            'payment_status' => PurchaseOrderPaymentStatus::UNPAID,
            'remarks' => fake()->sentence(),
        ];
    }

    public function withItems($count = 3)
    {
        return $this->afterCreating(function (PurchaseOrder $purchaseOrder) use ($count) {
            PurchaseOrderItem::factory()
                ->count($count)
                ->for($purchaseOrder)
                ->create();
        });
    }
}
