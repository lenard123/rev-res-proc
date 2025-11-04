<?php

namespace App\Domains\Attribute\Actions;

use App\Domains\Attribute\DTOs\AttributeDTO;
use App\Domains\Catalog\Actions\SaveItemAttributeAction;
use App\Domains\Catalog\DTOs\CreateItemDTO;
use App\Domains\Catalog\Models\Item;
use App\Domains\Core\Models\UnitOfMeasure;
use Illuminate\Support\Facades\DB;

class CreateItemAction
{
    /**
     * Summary of generateSku
     * @param string $parent_sku
     * @param AttributeDTO[] $attributes
     * @return string
     */
    private function generateSku(string $parent_sku, array $attributes)
    {
        $values = array_map(fn($attribute) => $attribute->value,$attributes);
        $values = implode("-", array_values($values));
        return "$parent_sku-$values";
    }

    /**
     * Summary of generateUniqueAttributeCombinations
     * @param array<string,array<mixed>> $configurable_attributes
     *       Example:
     *       [
     *           'color' => [1, 2, 3],
     *           'size' => [4, 5]
     *       ]
     * @return AttributeDTO[][]
     */
    private function generateUniqueAttributeCombinations(array $configurable_attributes)
    {
        $combinations = [ [] ];
        foreach ($configurable_attributes as $code => $values) 
        {
            $newly_transformed_combinations = [];
            foreach ($combinations as $combo)
            {
                foreach ($values as $value) 
                {
                    $new_combo = $combo + [$code => $value];
                    array_push($newly_transformed_combinations, $new_combo);
                }
            }
            $combinations = $newly_transformed_combinations;
        }
        return array_map(fn($combination) => AttributeDTO::mapFromArray($combination), $combinations) ;
    }

    private function createItem(CreateItemDTO $item_data)
    {
        $item = Item::create([
            'attribute_family_id' => $item_data->attribute_family_id,
            'sku' => $item_data->sku,
            'type' => $item_data->type,
            'parent_id' => $item_data->parent_id,
            'base_uom_id' => UnitOfMeasure::getID(UnitOfMeasure::CODE_PC),
        ]);

        foreach ($item_data->attributes as $attribute) {
            app(SaveItemAttributeAction::class)->handle(
                $item->id, 
                $attribute->attribute(),
                $attribute->value
            );
        }

        if ($item_data->type == Item::TYPE_CONFIGURABLE) {
            $combinations = $this->generateUniqueAttributeCombinations($item_data->configurable_attributes);
            foreach ($combinations as $combination) {
                $variant_sku = $this->generateSku($item_data->sku, $combination);
                $this->createItem(new CreateItemDTO(
                    $variant_sku,
                    Item::TYPE_SIMPLE,
                    $item->id,
                    $item_data->attribute_family_id,
                    $combination,
                    []
                ));
            }
        }

        return $item;
    }

    public function handle(CreateItemDTO $item_data): Item
    {
        return DB::transaction(fn() => self::createItem($item_data));
    }
}
