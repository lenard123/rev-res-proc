<?php

namespace Database\Seeders;

use App\Domains\Attribute\Models\Attribute;
use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Attribute\Models\AttributeOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'id' => 1,
                'code' => Attribute::CODE_SKU,
                'name' => 'SKU',
                'type' => Attribute::TYPE_TEXT,
                'is_unique' => true,
                'is_required' => true,
                'is_configurable' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'code' => Attribute::CODE_NAME,
                'name' => 'Name',
                'type' => Attribute::TYPE_TEXT,
                'is_unique' => false,
                'is_required' => true,
                'is_configurable' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'code' => Attribute::CODE_SIZE,
                'name' => 'Size',
                'type' => Attribute::TYPE_SELECT,
                'is_unique' => false,
                'is_required' => false,
                'is_configurable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'code' => Attribute::CODE_COLOR,
                'name' => 'Color',
                'type' => Attribute::TYPE_SELECT,
                'is_unique' => false,
                'is_required' => false,
                'is_configurable' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        $attribute_options = [
            ['id' => 1, 'attribute_id' => 3, 'name' => 'S', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'attribute_id' => 3, 'name' => 'M', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'attribute_id' => 3, 'name' => 'L', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'attribute_id' => 3, 'name' => 'XL', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'attribute_id' => 3, 'name' => '2XL', 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'attribute_id' => 4, 'name' => 'Red', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'attribute_id' => 4, 'name' => 'Black', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
        ];

        Attribute::insert($attributes);
        AttributeOption::insert($attribute_options);

        $attribute_families = collect([
            ['id' => 1, 'code' => AttributeFamily::DEFAULT_CODE, 'name' => 'Default', 'groups' => [
                ['code' => 'general', 'name' => 'General', 'attributes' => [
                    Attribute::CODE_SKU,
                    Attribute::CODE_NAME,
                    Attribute::CODE_COLOR,
                    Attribute::CODE_SIZE,
                ]]
            ]],
        ])->recursive();

        foreach ($attribute_families as $data) {
            $attribute_family = AttributeFamily::firstOrCreate(
                $data->only('code')->toArray(),
                $data->only('id', 'name')->toArray() + ['is_system' => true]
            );

            foreach ($data->get('groups') as $group) {
                $attribute_group = $attribute_family->groups()->firstOrCreate(
                    $group->only('code')->toArray(),
                    $group->only('name')->toArray(),
                );

                $attribute_ids = Attribute::whereIn('code', $group->get('attributes'))->pluck('id');
                $attribute_group->attributes()->syncWithoutDetaching($attribute_ids);
            }
        }
    }
}
