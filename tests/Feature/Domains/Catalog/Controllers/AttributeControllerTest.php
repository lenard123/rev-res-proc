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

    public function test_cannot_create_attribute_without_authentication(): void
    {
        $response = $this->postJson('/api/catalog/attributes', [
            'code' => Str::uuid()->toString(),
            'name' => fake()->text(),
            'type' => Attribute::TYPE_TEXT,
        ]);

        $response->assertStatus(401);
    }

    public function test_cannot_create_attribute_with_duplicate_code(): void
    {
        $code = Str::uuid()->toString();

        Attribute::create([
            'code' => $code,
            'name' => 'Existing Attribute',
            'type' => Attribute::TYPE_TEXT,
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/catalog/attributes', [
            'code' => $code,
            'name' => fake()->text(),
            'type' => Attribute::TYPE_TEXT,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['code']);
    }

    public function test_cannot_create_attribute_without_required_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/catalog/attributes', [
            'code' => Str::uuid()->toString(),
            'type' => Attribute::TYPE_TEXT,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }
}
