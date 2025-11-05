<?php

namespace App\Domains\Procurement\Factories;

use App\Domains\Core\Models\User;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

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