<?php

namespace Tests\Feature\Domains\Procurement\Controllers;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_purchase_request(): void
    {
        $this->seed();

        $item = Item::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/procurement/purchase-requests', [
            'purchase_request_items' => [
                ['item_id' => $item->id, 'quantity' => 10]
            ]
        ]);

        $response->assertStatus(201);
    }
}
