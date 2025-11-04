<?php

namespace Database\Seeders;

use App\Domains\Attribute\Actions\CreateItemAction;
use App\Domains\Attribute\DTOs\AttributeDTO;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Attribute\Models\Attribute;
use App\Domains\Attribute\Models\AttributeFamily;
use App\Domains\Catalog\Models\Item;
use App\Domains\Supplier\Actions\CreateSupplierAction;
use Illuminate\Database\Seeder;

class MockDataSeeder extends Seeder
{
    public function __construct(
        private CreateSupplierAction $createSupplier,
    ) {}

    private function getOptionId(Attribute $attribute, $value)
    {
        return $attribute->options()->where('name', $value)->value('id');
    }

    /**
     * Summary of searchItem
     * @param AttributeDTO[] $attributes
     * @return Item
     */
    private function searchItem(int $parent_id, array $attributes):Item
    {
        return Item::query()
            ->where('type', Item::TYPE_SIMPLE)
            ->where('parent_id', $parent_id)
            ->where(function ($itemQuery) use ($attributes) {
                foreach ($attributes as $attributeDTO) {
                    $itemQuery->whereHas('attributes', function ($sub) use ($attributeDTO) {
                        $sub->where(
                            $attributeDTO->attribute()->getValuesColumn(),
                            $attributeDTO->value
                        );
                    });
                }
            })
            ->firstOrFail();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DatabaseSeeder::class);

        $color = Attribute::where('code', Attribute::CODE_COLOR)->first();
        $size = Attribute::where('code', Attribute::CODE_SIZE)->first();

        $supplier_pilot = $this->createSupplier->handle(['name' => "Pilot"]);
        $supplier_pentel = $this->createSupplier->handle(['name' => "Pentel"]);

        $supplier_pilot_items_data = [
            'small_black' => [Attribute::CODE_SIZE => $this->getOptionId($size, 'S'), Attribute::CODE_COLOR => $this->getOptionId($color, 'Black')],
            'small_red' => [Attribute::CODE_SIZE => $this->getOptionId($size, 'S'), Attribute::CODE_COLOR => $this->getOptionId($color, 'Red')],
            'medium_red' => [Attribute::CODE_SIZE => $this->getOptionId($size, 'M'), Attribute::CODE_COLOR => $this->getOptionId($color, 'Red')],
        ];
        
        $supplier_pentel_items = [
            [Attribute::CODE_SIZE => $this->getOptionId($size, 'L'), Attribute::CODE_COLOR => $this->getOptionId($color, 'Black')],
        ];

        // Items Data
        $item_data =  [
            'sku' => 'ITM-0001', 
            'type' => Item::TYPE_CONFIGURABLE,
            'attributes' => [
                Attribute::CODE_NAME => 'Pentel Pen',
            ],
            'configurable_attributes' => [
                Attribute::CODE_COLOR => $color->options()->whereIn('name', ['Red', 'Black'])->pluck('id')->toArray(),
                Attribute::CODE_SIZE => $size->options()->whereIn('name', ['S', 'M', 'L'])->pluck('id')->toArray(),
            ]
        ];


        $attribute_family_code = data_get($item_data, 'attribute_family_code', AttributeFamily::DEFAULT_CODE);

        $item = app(CreateItemAction::class)->handle(new CreateItemDTO(
            $item_data['sku'],
            Item::TYPE_CONFIGURABLE,
            null,
            AttributeFamily::getID($attribute_family_code),
            AttributeDTO::mapFromArray($item_data['attributes']),
            $item_data['configurable_attributes'] ?? [],
        ));

        $pilot_items = array_map( function ($attributes)use ($item) {
            return self::searchItem($item->id, AttributeDTO::mapFromArray($attributes));
        }, $supplier_pilot_items_data);

        $pentel_items = array_map( function ($attributes)use ($item) {
            return self::searchItem($item->id, AttributeDTO::mapFromArray($attributes));
        }, $supplier_pentel_items);


        $small_black = $this->searchItem($item->id, AttributeDTO::mapFromArray($supplier_pilot_items_data['small_black']));
        $small_red = $this->searchItem($item->id, AttributeDTO::mapFromArray($supplier_pilot_items_data['small_red']));

        
    }
}
