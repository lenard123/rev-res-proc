<?php

namespace App\Domains\Procurement\Factories;

use App\Domains\Catalog\Models\Item;
use App\Domains\Procurement\Models\PurchaseRequest;
use App\Domains\Procurement\Models\PurchaseRequestItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseRequestItemFactory extends Factory
{
    protected $model = PurchaseRequestItem::class;

    public function definition(): array
    {
        return [
            'purchase_request_id' => PurchaseRequest::factory(),
            'item_id' => Item::factory(),
            'quantity_requested' => fake()->randomNumber(2, true),
            'remarks' => fake()->realText(),
        ];
    }
}