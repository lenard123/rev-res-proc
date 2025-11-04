<?php

namespace Tests\Feature\Domains\Catalog\Controllers;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Attribute\Models\AttributeOption;
use App\Domains\Catalog\Models\Item;
use App\Domains\Catalog\Models\ItemAttribute;
use App\Domains\Core\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_create_simple_item_successfully(): void
    {
        $this->seed();

        $sku = Str::uuid()->toString();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/api/catalog/items', [
            'sku' => $sku,
            'attribute_family_id' => AttributeFamily::value('id'),
            'type' => Item::TYPE_SIMPLE,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas(Item::class, [
            'sku' => $sku,
        ]);
    }

    public function test_create_configurable_item_successfully(): void
    {
        $this->seed();

        $sku = Str::uuid()->toString();

        $user = User::factory()->create();

        $color = Attribute::where('code', Attribute::CODE_COLOR)->first();
        $size = Attribute::where('code', Attribute::CODE_SIZE)->first();
        $response = $this->actingAs($user)->post('/api/catalog/items', [
            'sku' => $sku,
            'attribute_family_id' => AttributeFamily::value('id'),
            'type' => Item::TYPE_CONFIGURABLE,
            'configurable_attributes' => [
                Attribute::CODE_COLOR => $color->options()->whereIn('name', ['Red', 'Black'])->pluck('id')->toArray(),
                Attribute::CODE_SIZE => $size->options()->whereIn('name', ['S', 'M', 'L'])->pluck('id')->toArray(),
            ]
        ]);

        $response->assertStatus(201);
        $this->assertEquals(1, Item::where('type', Item::TYPE_CONFIGURABLE)->count());
        $this->assertEquals(6, Item::where('type', Item::TYPE_SIMPLE)->count());
    }
}
