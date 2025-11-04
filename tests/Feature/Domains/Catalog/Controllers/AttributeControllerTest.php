<?php

namespace Tests\Feature\Domains\Catalog\Controllers;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AttributeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_attribute_successfully(): void
    {
        $code = Str::uuid()->toString();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/catalog/attributes', [
            'code' => $code,
            'name' => fake()->text(),
            'type' => Attribute::TYPE_TEXT,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas(Attribute::class, [
            'code' => $code,
        ]);
    }
}
