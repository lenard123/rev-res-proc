<?php

namespace Tests\Feature\Domains\Procurement\Controllers;

use App\Domains\Core\Models\User;
use App\Domains\Procurement\Enums\PurchaseRequestStatus;
use App\Domains\Procurement\Models\PurchaseRequest;
use Database\Seeders\DummyItemSeeder;
use Database\Seeders\MockDataSeeder;
use Enterprisesuite\Feature\Facades\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseRequestItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_updating_of_purchase_request_items()
    {
        $this->seed(MockDataSeeder::class);

        $user = User::factory()->create();

        $purchase_request = PurchaseRequest::factory()
            ->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put("/api/procurement/purchase-requests/{$purchase_request->id}/items", [
            'purchase_request_items' => [
                ['item_id' => DummyItemSeeder::ITEM_L_BLACK_ID, 'quantity_requested' => 35],
                ['item_id' => DummyItemSeeder::ITEM_S_BLACK_ID, 'quantity_requested' => 12],
            ]
        ]);

        $response->assertStatus(200);
    }

    public function test_update_function_ensure_item_will_be_deleted_if_not_included_in_the_updated_data()
    {
        $this->markTestIncomplete();
    }

    public function test_update_function_ensure_no_item_is_duplicated()
    {
        $this->markTestIncomplete();
    }

    public function test_update_function_ensure_only_simple_item_type_can_be_requested()
    {
        $this->markTestIncomplete();
    }

    public function test_update_function_prevent_updating_of_non_draft_purchase_request()
    {
        $this->seed(MockDataSeeder::class);

        $user = User::factory()->create();

        $purchase_request = PurchaseRequest::factory()
            ->create(['user_id' => $user->id, 'status' => PurchaseRequestStatus::FOR_APPROVAL]);

        $response = $this->actingAs($user)->put("/api/procurement/purchase-requests/{$purchase_request->id}/items", [
            'purchase_request_items' => [
                ['item_id' => DummyItemSeeder::ITEM_L_BLACK_ID, 'quantity_requested' => 35],
                ['item_id' => DummyItemSeeder::ITEM_S_BLACK_ID, 'quantity_requested' => 12],
            ]
        ]);

        $response->assertStatus(409);
    }

}