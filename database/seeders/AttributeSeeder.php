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
            ['code' => Attribute::CODE_SKU, 'name' => 'SKU', 'type' => Attribute::TYPE_TEXT, 'is_unique' => true, 'is_required' => true],
            ['code' => Attribute::CODE_NAME, 'name' => 'Name', 'type' => Attribute::TYPE_TEXT, 'is_unique' => false, 'is_required' => true],
            ['code' => Attribute::CODE_SIZE, 'name' => 'Size', 'type' => Attribute::TYPE_SELECT, 'is_configurable' => true, 'options' => ['S', 'M', 'L', 'XL', '2XL']],
            ['code' => Attribute::CODE_COLOR, 'name' => 'Color', 'type' => Attribute::TYPE_SELECT, 'is_configurable' => true, 'options' => ['Red', 'Black']],
        ];

        foreach ($attributes as $data) {
            $attribute = Attribute::updateOrCreate(
                ['code' => $data['code']], 
                [
                    'name' => $data['name'],
                    'type' => $data['type'],
                    'is_unique' => $data['is_unique'] ?? false,
                    'is_required' => $data['is_required'] ?? false,
                    'is_configurable' => $data['is_configurable'] ?? false,
                    'is_system' => true
                ]
            );

            $options = data_get($data, 'options', []);
            if ($attribute->type === Attribute::TYPE_SELECT) {
                foreach ($options as $index => $name) {
                    AttributeOption::create([
                        'attribute_id' => $attribute->id,
                        'name' => $name,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        $attribute_families = collect([
            ['code' => AttributeFamily::DEFAULT_CODE, 'name' => 'Default', 'groups' => [
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
                $data->only('name')->toArray() + ['is_system' => true]
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
