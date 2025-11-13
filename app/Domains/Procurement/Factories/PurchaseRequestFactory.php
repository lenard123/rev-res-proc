<?php

namespace App\Domains\Procurement\Factories;

use App\Domains\Core\Models\User;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Summary of PurchaseRequestFactory
 * @extends Factory<PurchaseRequest>
 */
class PurchaseRequestFactory extends Factory
{
    protected $model = PurchaseRequest::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => PurchaseRequestStatus::DRAFT,
            'remarks' => "Test Purchase Request",
        ];
    }

    public function processing()
    {
        return $this->state(['status' => PurchaseRequestStatus::PROCESSING]);
    }

    public function withItems(int $count = 3)
    {
        return $this->afterCreating(function (PurchaseRequest $purchaseRequest) use ($count) {
            PurchaseRequestItem::factory()
                ->for($purchaseRequest)
                ->count($count)
                ->create();
        });
    }
}