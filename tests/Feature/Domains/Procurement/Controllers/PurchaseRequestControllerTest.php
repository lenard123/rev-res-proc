<?php

namespace Tests\Feature\Domains\Procurement\Controllers;

use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\User;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseRequestControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_function_successfully_purchase_request(): void
    {
        $this->seed();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/procurement/purchase-requests', [
            'remarks' => 'Testing Purchase Request'
        ]);

        $response->assertStatus(201);

        $response->assertJsonPath('data.remarks', 'Testing Purchase Request');
        $response->assertJsonPath('data.status', PurchaseRequestStatus::DRAFT);
    }

    public function test_process_function_successfully_process_request(): void
    {
        
    }
}
