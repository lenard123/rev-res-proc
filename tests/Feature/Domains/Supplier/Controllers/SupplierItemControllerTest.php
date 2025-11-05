<?php

namespace Tests\Feature\Domains\Supplier\Controllers;

use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Models\Supplier;
use App\Domains\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SupplierItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_adding_item_to_suppliers()
    {
        $this->seed();
        $supplier = Supplier::factory()->create();
        $items = Item::factory()->count(2)->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post("/api/supplier/suppliers/{$supplier->id}/items", [
            'item_ids' => $items->pluck('id')->toArray()
        ]);

        $response->assertStatus(204);
    }
}
