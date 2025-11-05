<?php

namespace Tests\Feature\Domains\Supplier\Controllers;

use App\Domains\Supplier\Models\Supplier;
use App\Domains\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class SupplierControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_supplier_successfully(): void
    {
        $code = Str::uuid()->toString();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/supplier/suppliers', [
            'code' => $code,
            'name' => fake()->company()
        ]);
        
        $response->assertStatus(201);

        $this->assertDatabaseHas(Supplier::class, ['code' => $code]);
    }
}
