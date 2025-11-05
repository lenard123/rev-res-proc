<?php

namespace App\Domains\Procurement\Factories;

use App\Domains\Core\Models\User;
use App\Domains\Procurement\Models\PurchaseRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseRequestFactory extends Factory
{
    protected $model = PurchaseRequest::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'status' => PurchaseRequest::STATUS_DRAFT,
            'remarks' => "Test Purchase Request",
        ];
    }
}